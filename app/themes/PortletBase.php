<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Widget;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Organisation;
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
        $this->view->pick(strtolower($portlet->type."/view"));
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $parameters= (array)json_decode($portlet->parameters,true);

        $this->view->setVar("parm", $parameters); 

        $this->view->setVar("portlet", $portlet); 
        
        $region=array();


        if($type=="builder")
        {
            for($i=0;$i<10;$i++)
            {
                $region[$i]='<div id="'.$id.'_row_'.$i.'" data-portlet-id="'.$id.'" data-row="'.$i.'" class="dropzone-portlet">
              </div>';
            }
        }
        else
        {
        
         for($i=0;$i<10;$i++)
            {
                $region[$i]='<div id="'.$id.'_row_'.$i.'" data-portlet-id="'.$id.'" data-row="'.$i.'">
              </div>';
            }
        
        }

        $this->view->setVar("region", $region); 

                $widgets = Widget::find(array(
                                        'portlet_id ='.$portlet->id,
                                        "order" => "column"
                                    ));

            
       foreach ($widgets as $widget) {
                echo '<script> 
                $("div").find("#'.$id.'_row_'.$widget->row.'").append( $("<div></div>").load("/widgets/'.$widget->type.'/render/'.$widget->id.'/'.$type.'", function(){';
           if($type=="builder"){
               echo 'parent.update_dropzone();';
           }
           echo '}));
                </script>';
            };
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
            "namespace" => "PRIME\Controllers",
            "controller" => "dashboard",
            "action"     => "edit",
            "params"     => array('id' => $portlet->dashboard_id)
            ));
        }
    }

    public function editAction($id)
    {
        $this->view->pick(strtolower($this->view_dir."/".$this->router->getControllerName()).'/edit');

        $this->view->setTemplateAfter('modal');
        
        $this->tag->setDefault("type", $this->router->getControllerName());
        
        $this->view->setVar("header_text", "Edit ". $this->widget_name);
        $this->view->setVar("icon", $this->icon);
        $this->view->setVar("form_type", "widget/save"); 
        
        $widget = Widget::findFirstByid($id);
        
        $this->view->setVar("widget_id", $id); 
        $this->view->setVar("type", $this->router->getControllerName()); 
        $this->tag->setDefault("id", $widget->id);
        $this->tag->setDefault("row", $widget->row);
        $this->tag->setDefault("width", $widget->width);
        $this->view->setVar("dashboard_id", $widget->dashboard_id);
        
        echo $this->tag->hiddenField("id");
        
        $parameters = json_decode($widget->parameters,true);
        
    }









 

    
}
