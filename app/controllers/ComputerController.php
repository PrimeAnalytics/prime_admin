<?php
 
namespace PRIME\Controllers;
use PRIME\Models\Computer;
use PRIME\Models\SecurityGroup;
use PRIME\Models\SecurityGroupHasComputer;

class ComputerController extends ControllerBase
{
    public $organisation_id ="";
    public function initialize()
    {   
        
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Computers');
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
        $data = Computer::find("organisation_id= ".$this->organisation_id);
        $this->view->setVar("computers", $data);  
    }


    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->tag->setDefault("organisation_id", $this->organisation_id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    /**
     * Edits a user
     *
     * @param string $email
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $computer = Computer::findFirstById($id);
            if (!$computer) {
                $this->flash->error("Computer was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "computer",
                    "action" => "index"
                ));
            }

            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
            $this->view->id = $computer->id;

            $this->tag->setDefault("id", $computer->id);
            $this->tag->setDefault("name", $computer->name);
            $this->tag->setDefault("type", $computer->type);
            $this->tag->setDefault("key", $computer->key);
            $this->tag->setDefault("data", $computer->data);

            $this->tag->setDefault("organisation_id", $computer->organisation_id);

            $this->view->setVar("computer", $computer); 
                 
        }
    }
   

    /**
     * Creates a new user
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "computer",
                "action" => "index"
            ));
        }

        $computer = new Computer();

        $computer->id = $this->request->getPost("id");
        $computer->name = $this->request->getPost("name");
        $computer->type = $this->request->getPost("type");
        $computer->data = $this->request->getPost("data");
        $computer->key = md5(uniqid(rand(), true));

        $computer->organisation_id = $this->request->getPost("organisation_id");
        

        if (!$computer->save()) {
            foreach ($computer->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                        "namespace" => "PRIME\Controllers",
                        "controller" => "computer",
                        "action"     => "index"
                        ));
        }
        
        
        $this->flash->success("Computer was successfully added");

        return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Controllers",
            "controller" => "computer",
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
                "controller" => "computer",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $computer = Computer::findFirstById($id);
        if (!$computer) {
            $this->flash->error("Computer does not exist ");

            return $this->dispatcher->forward(array(
                "controller" => "computer",
                "action" => "index"
            ));
        }

        $computer->name = $this->request->getPost("name");
        $computer->type = $this->request->getPost("type");
        $computer->data = $this->request->getPost("data");
        $computer->key = $this->request->getPost("key");

        $computer->organisation_id = $this->request->getPost("organisation_id");
        

        if (!$computer->save()) {

            foreach ($computer->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "namespace" => "PRIME\Controllers",
                        "controller" => "computer",
                        "action"     => "index"
                        ));
        }

        $this->flash->success("Computer was updated successfully");

        return $this->dispatcher->forward(array(
                    "namespace" => "PRIME\Controllers",
                    "controller" => "computer",
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
        $id=$this->request->getPost("id");

        $computer = Computer::findFirstById($id);
        if (!$computer) {
            $this->flash->error("Computer does not exist ");

            return $this->dispatcher->forward(array(
                "controller" => "computer",
                "action" => "index"
            ));
        }

        if (!$computer->delete()) {

            foreach ($computer->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "computer",
                "action" => "index"
            ));
        }

        $this->flash->success("Computer was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "computer",
            "action" => "index"
        ));
    }

}
