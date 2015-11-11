<?php
 
namespace PRIME\Controllers;
use PRIME\Models\Users;
use PRIME\Models\Dashboard;
use PRIME\Models\DashboardHasUsers;

class UsersController extends ControllerBase
{
    public $organisation_id ="";
    public function initialize()
    {   
        
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Users');
        parent::initialize();
        $auth = $this->session->get("auth");
        $this->organisation_id= $auth['organisation_id'];
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $data = Users::find("organisation_id= ".$this->organisation_id);
        $this->view->setVar("users", $data);  
    }


    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->tag->setDefault("status", "enable");
        $this->tag->setDefault("image_path", '/assets/global/images/avatars/avatar11_big@2x.png');
        $this->tag->setDefault("organisation_id", $this->organisation_id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    /**
     * Edits a user
     *
     * @param string $email
     */
    public function editAction($email)
    {

        if (!$this->request->isPost()) {

            $user = Users::findFirstByemail($email);
            if (!$user) {
                $this->flash->error("user was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "users",
                    "action" => "index"
                ));
            }

            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
            $this->view->email = $user->email;

            $this->tag->setDefault("email", $user->email);
            $this->tag->setDefault("full_name", $user->full_name);
            $this->tag->setDefault("image_path", $user->image_path);
            $this->tag->setDefault("password", $user->password);
            $this->tag->setDefault("role", $user->role);
            $this->tag->setDefault("status", $user->status);
            $this->tag->setDefault("organisation_id", $user->organisation_id);
            
            
            $userdata = $user->dashboard;
            $this->view->setVar("user_dashboards", $userdata);
            
            $data = Dashboard::find("organisation_id=".$user->organisation_id);

            $data=$data->toArray();

            foreach($userdata->toArray() as $dashboard)
            {
                if(($key = array_search($dashboard, $data)) !== false) {
                    unset($data[$key]);
                }
            }
            $object = json_decode(json_encode($data), FALSE);
           
            $this->view->setVar("dashboards", $object); 
            $this->view->setVar("user", $user); 
                 
        }
    }
    
    
    public function enable_dashboardAction($dashboard_id,$users_email)
    {

        $dashboard_has_user = new DashboardHasUsers();

        $dashboard_has_user->dashboard_id = $dashboard_id;
        $dashboard_has_user->users_email = $users_email;
        

        if (!$dashboard_has_user->save()) {

        }

        $this->flash->success("Dashboard was successfully enabled");
        return $this->dispatcher->forward(array(
                                                "namespace" => "PRIME\Controllers",
                                                "controller" => "users",
                                                "action"     => "index"
                                                ));

    }
    
    
    public function disable_dashboardAction($dashboard_id,$users_email)
    {
        $dashboard_has_user = DashboardHasUsers::findFirst(array("dashboard_id= $dashboard_id","users_email= $users_email"));
        

        if (!$dashboard_has_user->delete()) {

        }

        $this->flash->success("Dashboard was successfully disabled");
        return $this->dispatcher->forward(array(
    "namespace" => "PRIME\Controllers",
    "controller" => "users",
    "action"     => "index"
    ));

    }
    

    /**
     * Creates a new user
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user = new Users();

        $user->email = $this->request->getPost("email", "email");
        $user->full_name = $this->request->getPost("full_name");
        $user->image_path = $this->request->getPost("image_path");
        $user->password = sha1($this->request->getPost("password"));
        $user->role = $this->request->getPost("role");
        $user->status = $this->request->getPost("status");
        $user->organisation_id = $this->request->getPost("organisation_id");
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                        "namespace" => "PRIME\Controllers",
                        "controller" => "users",
                        "action"     => "index"
                        ));
        }
        
        
        $this->flash->success("User was created successfully");

        return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Controllers",
            "controller" => "users",
            "action"     => "index"
            ));
        
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $email = $this->request->getPost("email");

        $user = Users::findFirstByemail($email);
        if (!$user) {
            $this->flash->error("user does not exist " . $email);

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user->email = $this->request->getPost("email", "email");
        $user->full_name = $this->request->getPost("full_name");
        $user->image_path = $this->request->getPost("image_path");
        
        $user->role = $this->request->getPost("role");
        $user->status = $this->request->getPost("status");
        $user->organisation_id = $this->request->getPost("organisation_id");


        if($this->request->getPost("password")!=$user->password)
        {
            $user->password = sha1($this->request->getPost("password"));
        }
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "namespace" => "PRIME\Controllers",
                        "controller" => "users",
                        "action"     => "index"
                        ));
        }

        $this->flash->success("User was updated successfully");

        return $this->dispatcher->forward(array(
                    "namespace" => "PRIME\Controllers",
                    "controller" => "users",
                    "action"     => "index"
                    ));

    }

    /**
     * Deletes a user
     *
     * @param string $email
     */
    public function deleteAction()
    {
        $email=$this->request->getPost("id");

        $user = Users::findFirstByemail($email);
        if (!$user) {
            $this->flash->error("User was not found");

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $this->flash->success("User was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));
    }

}
