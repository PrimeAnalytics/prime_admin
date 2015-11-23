<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Organisation;
use PRIME\Models\Login;

class LoginBase extends Controller
{    
    public $login_type = "";
    public $organisation_id ="";
    private $view_dir;
    public $form_struct='';
    
    function onConstruct()
    {
        $this->login_type = __CLASS__;
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
        }

    }

    public function newAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;

        $this->view->setViewsDir('../app/views/');
        $this->view->pick('logins/new');

        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);

        $this->view->setVar("form_body", $form_body);
        $this->view->setVar("type", $this->login_type);

        $form_type='/logins/'.str_replace(" ","_",strtolower($this->login_type)).'/create';
        $this->view->setVar("form_type", $form_type);
 
    }

    public function editAction($id)
    {
        $this->view->setViewsDir('../app/views/');
        $this->view->pick('login/edit');

        $this->view->id = $login->id;
            
        $this->tag->setDefault("type", $login->type);
        $this->tag->setDefault("id", $login->id);
        $this->tag->setDefault("name", $login->name);
        $this->tag->setDefault("organisation_id", $login->organisation_id);

    }


    public function renderAction($id)
    {
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->view->setViewsDir('../app/themes/'.$auth['theme'].'/logins/');
        }
        
        $login = Login::findFirstByid($id);    
        $organisation= Organisation::findFirstByid($login->organisation_id);

        $this->view->pick(strtolower($login->type."/view"));
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $parameters= (array)json_decode($login->parameters,true);

        $this->view->setVar("parm", $parameters); 

        $this->view->setVar("login", $login); 
        $this->view->setVar("organisation", $organisation);
        
    }

    public function createAction()
    {
        $login = new Login();

        $login->type = $this->dashboard_name;
        $login->name = $this->request->getPost("column");
        $login->organisation_id = $this->request->getPost("organisation_id");

        $login->parameters = json_encode($this->request->getPost("parameters"));

        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Login was created successfully");

            return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Controllers",
            "controller" => "organisation",
            "action"     => "edit",
            "params"     => array('id' =>  $login->organisation_id )
            ));
        }
    }

 
    
}
