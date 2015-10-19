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
    public $dataFormat="ByRow";
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

       $widget = Widget::findFirstByid($id);  
       $parameters= (array)json_decode($widget->parameters,true);

       if(array_key_exists("db",$parameters))
       {

           $widget_links= array();
           
           if($links!=null && $parameters['update_links']!="")
           {
               
               foreach($links as $link)
               {
                   if(in_array ( $link["id"] ,  $parameters['update_links'], true))
                   {
                       if($link['default_value']=="")
                       {
                           return null;
                       }
                       
                       $widget_links[]=$link;
                       
                   }
               }
           }





           $parameters=call_user_func(array($this, 'getData'.$this->dataFormat), $parameters,$widget_links);

       }

       $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

       $this->view->setViewsDir($this->view_dir);

       $type=explode("/",$widget->type);    
       
       $this->view->pick(strtolower(end($type)."/view"));

       $this->view->setVar("parm", $parameters); 

       $this->view->setVar("widget", $widget);

    
    
    }


    public function renderAction($id,$type)
    {
        
        $widget = Widget::findFirstByid($id);  
        $parameters= (array)json_decode($widget->parameters,true);
        $this->view->Disable();

        echo str_replace("{{widget.id}}", $id, $this->container);

        echo '<script>
          var update_'.$widget->id.' = function(link){
                      
          var w_links ='.(array_key_exists ( 'update_links' , $parameters )? (($parameters['update_links']=="")? "[]" : json_encode($parameters['update_links'],true)) : "[]").';
          
          
          var widget_id ='.$widget->id.';
          var widget_type ="'.$widget->type.'";
           
            var update=false;
            
            if( link === \'load\' )
            {
            update=true;
            }
            else
            {
            
            $.each(w_links, function(index, key ) {
                      if( w_links[index]==link)
                      {                      
                      update=true;
                      return false;
                      }
                      })
            }

            if(update == true)
            {
           
            $( "#widget_'.$id.'" ).load( "/widgets/'.$widget->type.'/update/'.$id.'", { "links": links } );
            }
            
            
          };';
        
        echo 'update_'.$widget->id.'(\'load\');

        </script>';

 
    }

    public function getDataByRow($parameters,$links=null)
    {
        $processController = new \PRIME\Controllers\ProcessController();
        $data=$processController->getResults($parameters["db"]['table'],$links);

        $dbTemp=$parameters["db"];
        $parameters["db"]=array();

        foreach($data as $key=>$row)
        {
            $temp=array();
            foreach($dbTemp as $parmKey=>$parmValue)
            {
                if($parmKey!='table')
                {
                    $temp[$parmKey]=$row[$parmValue];    
                }
            }

            $parameters["db"][]=$temp;
        }

        return $parameters;
    
    }

    public function getDataByColumn($parameters,$links=null)
    {
        $processController = new \PRIME\Controllers\ProcessController();
        $data=$processController->getResults($parameters["db"]['table'],$links);

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
