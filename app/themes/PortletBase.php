<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Widget;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Organisation;
use PRIME\Models\Dashboard;
use PRIME\Models\Portlet;

class PortletBase extends Controller
{    
    public $portlet_name = "";
    public $organisation_id ="";
    public $theme ="";
    public $form_struct='';
    
    function onConstruct()
    {
        $portlet_name = $this->router->getControllerName();
        $portlet_name = str_replace('_', ' ', $portlet_name);
        $this->portlet_name = ucwords($portlet_name);
        
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
            $this->theme= $auth['theme'];
        }
        
    }

    public function renderAction($id,$type)
    {
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->view->setViewsDir('../app/themes/'.$auth['theme'].'/portlets/');
        }
        
        $portlet = Portlet::findFirstByid($id);   
        $dashboard = Dashboard::findFirstByid($portlet->dashboard_id); 
        $dashparm =json_decode($dashboard->parameters,true);
        $this->view->pick(strtolower($portlet->type."/view"));
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $parameters= (array)json_decode($portlet->parameters,true);

        $this->view->setVar("parm", $parameters); 

        $this->view->setVar("portlet", $portlet); 
        
        $region=array();
        $widgets = Widget::find(array(
                                  'portlet_id ='.$portlet->id,
                                  "order" => "column"
                              ));


            for($i=0;$i<10;$i++)
            {
                $region[$i]='<div id="portlet_'.$id.'_row_'.$i.'" data-portlet-id="'.$id.'" data-row="'.$i.'" class="dropzone-portlet grid-stack grid-stack-12">';
                

                $region[$i] .= '

                          </div>';

                echo '
  <script type="text/javascript">
        $(function () {
            var options = {
                float: false,
                cellHeight: 40,
                verticalMargin: 5
            };
            $("#portlet_'.$id.'_row_'.$i.'").gridstack(options);

            $("#portlet_'.$id.'_row_'.$i.'").each(function () {
                var grid = $(this).data("gridstack");


                
';

                foreach ($widgets as $widget) {
                    
                    if($widget->row == $i)
                    {
                        $x=1;
                        $y=1;
                        $height=4;
                        $width=6;

                        if( array_key_exists("layout",$dashparm))
                        {
                            foreach($dashparm["layout"] as $layout)
                            {
                                if( $layout["thisId"]==$widget->id && $layout["regionId"]==$i && $layout["thisType"]=="widget" && $layout["parentId"]==$id)
                                {
                                    $x=$layout["x"];
                                    $y=$layout["y"];
                                    $height=$layout["h"];
                                    $width=$layout["w"];
                                    continue;
                                }
                            }
                        }
                        
                        echo 'var el = grid.add_widget($("<div><div class=\'grid-stack-item-content builder-widget\' data-type=\"'.$widget->type.'\" data-id=\"'.$widget->id.'\" ><div id=\'widget_temp_'.$widget->id.'\'></div></div></div>"),
                        '.$x.', '.$y.', '.$width.', '.$height.');
                    el.attr(\'data-this-id\', "'.$widget->id.'");
                    el.attr(\'data-parent-id\', "'.$id.'");
                    el.attr(\'data-region-id\', "'.$i.'");
                    el.attr(\'data-this-type\', "widget");
                 ';
                    }
                }


                if($type!="builder")
                {
                    echo '

                    grid.movable(\'.grid-stack-item\', false);
                    grid.resizable(\'.grid-stack-item\', false);
                    ';
                }
                echo '
}, this);


            });



    </script> ';
            }



        $this->view->setVar("region", $region); 

          

                    foreach ($widgets as $widget) {
                        echo '<script> 
            $.post("/widgets/'.$widget->type.'/render/'.$widget->id.'/'.$type.'", function(data) {';
                if($type=="builder"){
                echo' $("#widget_temp_'.$widget->id.'").replaceWith(data);';
                echo 'parent.update_dropzone(); 
                        parent.iframe_load();';
                        }
                else{
                    echo '
                $("#widget_temp_'.$widget->id.'").replaceWith(data);';

                }
                        echo "}); </script>";

                }
        }

    public function newAction($dashboard_id,$row,$column)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;

        $this->view->setViewsDir('../app/views/');
        $this->view->pick('portlets/new');

        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);

        $this->tag->setDefault("row", $row);
        $this->tag->setDefault("column", $column);
        $this->tag->setDefault("dashboard_id", $dashboard_id);

        $this->view->setVar("form_body", $form_body);
        $this->view->setVar("type", $this->portlet_name);

        $form_type='/portlets/'.str_replace(" ","_",strtolower($this->portlet_name)).'/create';
        $this->view->setVar("form_type", $form_type);
        
 
    }

    public function createAction()
    {
        $portlet = new Portlet();

        $portlet->type =str_replace(" ","_",strtolower($this->portlet_name));
        $portlet->column = $this->request->getPost("column");
        $portlet->row = $this->request->getPost("row");
        $portlet->dashboard_id = $this->request->getPost("dashboard_id");

        $dashboard=Dashboard::findFirstById($portlet->dashboard_id);
        
        $portlet->parameters = json_encode($this->request->getPost("parameters"));

        if (!$portlet->save()) {
            foreach ($portlet->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Portlet was created successfully");
            

            return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Themes\\".$this->theme."\dashboards",
            "controller" => $dashboard->type,
            "action"     => "edit",
            "params"     => array('id' => $portlet->dashboard_id)
            ));
        }
    }

    public function editAction($id)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;

        $this->view->setViewsDir('../app/views/');
        $this->view->pick('portlets/edit');

        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);

        $this->tag->setDefault("id", $id);

        $this->view->setVar("form_body", $form_body);
        $this->view->setVar("type", $this->portlet_name);

        $form_type='/portlets/'.str_replace(" ","_",strtolower($this->portlet_name)).'/save';
        $this->view->setVar("form_type", $form_type);
        
    }


    public function saveAction()
    {
   
        $id = $this->request->getPost("id");
        $portlet = Portlet::findFirstByid($id);

        $portlet->parameters = json_encode($this->request->getPost("parameters"));

        if (!$portlet->save()) {
            foreach ($portlet->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Portlet was saved successfully");
            $dashboard=Dashboard::findFirstById($portlet->dashboard_id);

            return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Themes\\".$this->theme."\dashboards",
            "controller" => $dashboard->type,
            "action"     => "edit",
            "params"     => array('id' => $portlet->dashboard_id)
            ));
        }
    }

    public function deleteAction()
    {
        $id = $this->request->getPost("id");
        $portlet = Portlet::findFirstByid($id);
        $widgets=$portlet->Widget;
        
        
        foreach($widgets as $widget)
        {
            $widget->delete();
        }
        

        if (!$portlet->delete()) {

            foreach ($portlet->getMessages() as $message) {
                $this->flash->error($message);
            }

        }
        else
        {
            $this->flash->success("Portlet was deleted successfully");
        }
        
        $dashboard=Dashboard::findFirstById($portlet->dashboard_id);

        return $this->response->redirect("/dashboards/".$dashboard->type."/edit/".$dashboard->id);
    }









 

    
}
