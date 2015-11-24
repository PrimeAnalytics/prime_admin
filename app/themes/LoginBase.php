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
    public $theme='';
    
    function onConstruct()
    {
        $this->login_type = $this->router->getControllerName();;
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
            $this->theme= $auth['theme'];
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
        $login = Login::findFirstByid($id); 
        $this->view->setViewsDir('../app/views/');
        $this->view->pick('logins/edit');

        $this->view->setVar('form_type','/'.$login->type.'/save/'.$login->id);
        $this->view->setVar('type',$login->type);
            
        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);
        $this->view->setVar("form_body", $form_body);

        $this->tag->setDefault("type", $login->type);
        $this->tag->setDefault("id", $login->id);
        $this->tag->setDefault("url", $login->url);

    }


    public function renderAction($id)
    {
        
        
        $login = Login::findFirstByid($id);    
        $this->view->setViewsDir('../app/themes/'.$login->theme.'/logins/');
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);

        $this->view->pick(strtolower($login->type."/view"));

        $parameters= (array)json_decode($login->parameters,true);

        $this->view->setVar("parm", $parameters); 

        $this->view->setVar("login", $login); 
        
    }

    public function createAction()
    {
        $login = new Login();

        $login->type = $this->login_type;
        $login->theme = $this->theme;
        $login->url = $this->request->getPost("url");
        $login->organisation_id = $this->organisation_id;
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
