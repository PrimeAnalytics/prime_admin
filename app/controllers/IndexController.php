<?php
namespace PRIME\Controllers;
use PRIME\Models\Users;
use PRIME\Models\Organisation;
use PRIME\Models\Login;

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
        $auth = $this->session->get("auth");
        return $this->dispatcher->forward(array(
            "controller" => "organisation",
            "action" => "edit",
            "params" => array($auth['organisation_id'])
        ));
    }
    
    public function supervisorAction()
    {
        
    }

    public function guestAction()
    {

        return $this->dispatcher->forward(array(
                "controller" => "session",
                "action" => "index"
            ));  
        
    }
    
    
    public function userAction()
    {
        $auth = $this->session->get('auth');
        
        $email = $auth['email'];


        $user = Users::findFirstByemail($email);

        $security_groups = $user->SecurityGroup;

        $user_dashboards = array();

        foreach($security_groups as $security_group)
        {
            $dashboards = $security_group->Dashboard;
            $user_dashboards =array_merge ($user_dashboards,$dashboards->ToArray());
        }
 
        if( $user_dashboards)     
        {
            $dashboard=$user_dashboards[0];
            $this->response->redirect("/dashboards/".$dashboard['type']."/render/".$dashboard['id']."/dashboard");
        }

    }
    
    
    
    
}


