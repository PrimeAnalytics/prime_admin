<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Widget;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Organisation;
use PRIME\Models\Portlet;
use PRIME\Models\Dashboard;


class WidgetBase extends Controller
{    
    public $widget_name = "";
    public $organisation_id ="";
    private $view_dir;
    public $form_struct='';
    public $theme='';
    public $data_format="ByRow";
    public $container="";
    
    function onConstruct()
    { 
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
        }

        
        $organisation = Organisation::findFirstById($this->organisation_id);

        $widget_name =  str_replace('PRIME\Themes\\'.ucwords($organisation->theme).'\Widgets\\', '', $this->router->getNamespaceName())."/".$this->router->getControllerName();
        $widget_name = strtolower(str_replace('_', ' ', $widget_name));
        $this->widget_name = $widget_name;
        
        $this->theme=$organisation->theme;
        
        $this->view_dir = '../app/themes/'.$auth['theme'].'/widgets/'.str_replace('PRIME\Themes\\'.ucwords($organisation->theme).'\Widgets\\', '', $this->router->getNamespaceName()).'/';
        
    }

    public function updateAction($id)
    {
       $links= $this->request->getPost("links");
       $variables= $this->request->getPost("variables");

       $widget = Widget::findFirstByid($id);  
       $parameters= (array)json_decode($widget->parameters,true);

       if(array_key_exists("db",$parameters))
       {

           $widget_links= array();
           
           if($links!=null)
           {

               foreach($links as &$link)
               {
                   if(!array_key_exists("default_value",$link))
                   {
                       $link['default_value']="";
                   }

                 
               }
           }

           $parameters=call_user_func(array($this, 'getData'.$this->data_format), $parameters,$links,$variables);

       }

       $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

       $this->view->setViewsDir($this->view_dir);

       $type=explode("/",$widget->type);    
       
       $this->view->pick(strtolower(end($type)."/view"));

       $controls= '<style>
        #widget_'.$widget->id.' {
        transition: 1s display;
        transition-delay:1s;
        }
        .widget-controls { display:none; background-color:rgba(255,255,255,0.8); }

        #widget_'.$widget->id.':hover .widget-controls , #widget_'.$widget->id.'.hover .widget-controls { display:block; position: absolute; top:0px; right: 0px; z-index:2147483647; }
        </style>

        <div class="widget-controls"><a class="widget-control"   onclick="reset_'.$widget->id.'()"><i class="fa fa-times"></i></a>
        <a class="widget-control" onclick="update_'.$widget->id.'(\'set\')"><i class="fa fa-check-circle-o"></i></a></div>';

       $this->view->setVar("controls", $controls); 

       $this->view->setVar("parm", $parameters); 

       $this->view->setVar("widget", $widget);

    
    
    }

    public function renderAction($id)
    {
        $widget = Widget::findFirstByid($id);  
        $parameters= (array)json_decode($widget->parameters,true);
        $this->view->Disable();
        echo '<div id="widget_'.$id.'"></div>';
        
        echo '<script>

        var reset_'.$widget->id.' = function(){';
        if(array_key_exists ("target_link",$parameters))
        {
            echo 'update_dashboard("'.$parameters['db']['table'].'","'.$parameters['target_link'].'", "","");';
        }
        echo '}; ';

        echo'
var xhr_'.$widget->id.';
var update_'.$widget->id.' = function(){
try {
xhr_'.$widget->id.'.abort();
}
catch(err) {
};

$("#widget_'.$id.'").append("<div class=\"ajax-loader\"><div class=\'ajax-spinner-bars\'><div class=\'bar-1\'></div><div class=\'bar-2\'></div><div class=\'bar-3\'></div><div class=\'bar-4\'></div><div class=\'bar-5\'></div><div class=\'bar-6\'></div><div class=\'bar-7\'></div><div class=\'bar-8\'></div><div class=\'bar-9\'></div><div class=\'bar-10\'></div><div class=\'bar-11\'></div><div class=\'bar-12\'></div><div class=\'bar-13\'></div><div class=\'bar-14\'></div><div class=\'bar-15\'></div><div class=\'bar-16\'></div></div></div>");


           xhr_'.$widget->id.' = $.post("/widgets/'.$widget->type.'/update/'.$id.'", { links: links , variables:variables}, function(data) {
                 $("#widget_'.$id.'").replaceWith(data);
            });
            
          }; ';
        
        echo 'update_'.$widget->id.'();

        </script>';

 
    }

    public function getDataByRow($parameters,$links=null,$variables=null)
    {
        $processController = new \PRIME\Controllers\ProcessController();
        $data=$processController->getResults($parameters["db"]['table'],$links,$variables);

        $dbTemp=$parameters["db"];
        $parameters["db"]=array();

        foreach($data as $key=>$row)
        {
            $temp=array();
            foreach($dbTemp as $parmKey=>$parmValue)
            {
                if(is_array($parmValue))
                {
                foreach($parmValue as $sub_key=>$parm)
                {
                    $temp[$parmKey][$parm]=$row[$parm];
                }

                }
                else if($parmKey!='table')
                {
                    $temp[$parmKey]=$row[$parmValue];    
                }
            }

            $parameters["db"][]=$temp;
        }

        return $parameters;
    
    }

    public function getDataChart($parameters,$links=null,$variables=null)
    {
        $processController = new \PRIME\Controllers\ProcessController();
        $data=$processController->getResults($parameters["db"]['table'],$links,$variables);
        $dbTemp=$parameters["db"];

        $data_layout=$parameters["db"];
        $data_layout['series']=explode(',',$data_layout['series'][0]);
        $parameters["db"]=array();

	    $out = array();
        foreach ($data as $key => $subarr) {
    	    foreach ($data_layout['series'] as $subkey) {
			    $out[$subkey][$key] = array('x_axis'=>$subarr[$data_layout['x_axis']] ,'value'=>$subarr[$subkey]) ;			 
    	    }
        }

        $parameters["db"]=$out;
        return $parameters;
    }

    public function getDataByColumn($parameters,$links=null,$variables=null)
    {
        $processController = new \PRIME\Controllers\ProcessController();
        $data=$processController->getResults($parameters["db"]['table'],$links,$variables);

        $dbTemp=$parameters["db"];
        $parameters["db"]=array();

        foreach($data as $key=>$row)
        {
            foreach($dbTemp as $parmKey=>$parmValue)
            {
                if($parmKey!='table')
                {
                    $parameters["db"][$parmKey][]=$row[$parmValue];   
                }
            }

        }



        return $parameters;
        
    }

    public function newAction($portlet_id,$row,$column)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;

        $this->view->setViewsDir('../app/views/');
        $this->view->pick('widgets/new');

        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);

        $this->tag->setDefault("row", $row);
        $this->tag->setDefault("column", $column);
        $this->tag->setDefault("portlet_id", $portlet_id);

        $this->view->setVar("form_body", $form_body);
        $this->view->setVar("type", $this->widget_name);

        $form_type='/widgets/'.str_replace(" ","_",strtolower($this->widget_name)).'/create';
        $this->view->setVar("form_type", $form_type);
        
        
    }

    public function createAction()
    {
        $widget = new Widget();

        $widget->type = str_replace(" ","_",strtolower($this->widget_name));
        $widget->column = $this->request->getPost("column");
        $widget->row = $this->request->getPost("row");
        $widget->portlet_id = $this->request->getPost("portlet_id");
        
        $widget->parameters = json_encode($this->request->getPost("parameters"));

        if (!$widget->save()) {
            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Widget was created successfully");

            $portlet = Portlet::findFirstById($widget->portlet_id);
            
            $dashboard=Dashboard::findFirstById($portlet->dashboard_id);

           return $this->response->redirect("/dashboards/".$dashboard->type."/edit/".$dashboard->id);
        }
    }
    
    public function editAction($id)
    {
        $widget = Widget::findFirstByid($id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;

        $this->view->setViewsDir('../app/views/');
        $this->view->pick('widgets/edit');

        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);

        $this->tag->setDefault("id", $id);
        
        //$this->tag->setDefault("parameters", json_decode($widget->parameters));
        
        $this->view->setVar("form_body", $form_body);
        $this->view->setVar("type", $this->widget_name);

        $form_type='/widgets/'.str_replace(" ","_",strtolower($this->widget_name)).'/save';
        $this->view->setVar("form_type", $form_type);
             
    }

    public function saveAction()
    {
        $id = $this->request->getPost("id");

        $widget = Widget::findFirstByid($id);

        if($this->request->getPost("column") != NULL)
        {
            $widget->column = $this->request->getPost("column");
        }
        
        if($this->request->getPost("row") != NULL)
        {
            $widget->row = $this->request->getPost("row");
        }
      
        if($this->request->getPost("portlet_id") != NULL)
        {
            $widget->canvas_id = $this->request->getPost("portlet_id");
        }
        
        if($this->request->getPost("parameters") != NULL)
        {
            $widget->parameters = json_encode($this->request->getPost("parameters"),true);
        }
        

        if (!$widget->save()) {
            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Widget was saved successfully");

            $portlet = Portlet::findFirstById($widget->portlet_id);
            
            $dashboard=Dashboard::findFirstById($portlet->dashboard_id);

            return $this->response->redirect("/dashboards/".$dashboard->type."/edit/".$dashboard->id);
        }
        
        
    }


    public  function  deleteAction()
    {
        $id = $this->request->getPost("id");
        $widget = Widget::findfirst('id ='.$id);
        if (!$widget->delete()) {

            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }

        }
        else
        {
            $this->flash->success("widget was deleted successfully");
        }

        $portlet = Portlet::findFirstById($widget->portlet_id);
        
        $dashboard=Dashboard::findFirstById($portlet->dashboard_id);

        return $this->response->redirect("/dashboards/".$dashboard->type."/edit/".$dashboard->id);
    }
}
