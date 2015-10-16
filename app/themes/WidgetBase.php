<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Widget;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Organisation;
use PRIME\Models\Canvas;

class WidgetBase extends Controller
{    
    public $widget_name = "";
    public $organisation_id ="";
    private $view_dir;
    public $form_struct='';
    public $theme='';
    
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


    public function renderAction($id,$type)
    {
        $this->view->setViewsDir($this->view_dir);

        $widget = Widget::findFirstByid($id);  

        $type=explode("/",$widget->type);    
      
        $this->view->pick(strtolower(end($type)."/view"));

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $parameters= (array)json_decode($widget->parameters,true);

        $this->view->setVar("parm", $parameters); 

        $this->view->setVar("widget", $widget); 
 
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

        $form_type='/widgets/'.$this->widget_name.'/create';
        $this->view->setVar("form_type", $form_type);
        
        
    }

    public function createAction()
    {
        $widget = new Widget();

        $widget->type = $this->widget_name;
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

            return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Controllers",
            "controller" => "dashboard",
            "action"     => "edit",
            "params"     => array('id' => $widget->portlet_id)
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
