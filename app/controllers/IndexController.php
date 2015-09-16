<?php
namespace PRIME\Controllers;
use PRIME\Models\Users;

class IndexController extends ControllerBase
{
    public function initialize()
    {          
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
    }
    
    public function indexAction()
    {
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $role= $auth['role'];
            
            return $this->dispatcher->forward(array(
"controller" => "Index",
"action" => $role
)); 
        }
        else
        {
            return $this->dispatcher->forward(array(
     "controller" => "session",
     "action" => "index"
 )); 
        }
    }
    

    public function adminAction()
    {
        return $this->dispatcher->forward(array(
            "controller" => "organisation",
            "action" => "index"
        ));
    }
    
    public function supervisorAction()
    {
        
    }
    
    
    public function userAction()
    {
        $auth = $this->session->get('auth');
        
        $email = $auth['email'];
        
        $user = Users::findFirstByemail($email);
        $user_dashboards = $user->dashboard;
        
        if( $user_dashboards)     
        {
            return $this->dispatcher->forward(array(
            "controller" => "dashboard",
            "action" => "render",
            "params" => array($user_dashboards[0]->id, "dashboard")
            ));  
        }

    }
    
    
    
    
}


