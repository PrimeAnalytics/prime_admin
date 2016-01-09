<?php
namespace PRIME\Controllers;
use PRIME\Models\Process;
use PRIME\Models\ProcessScheduled;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;

class OrgDatabaseController extends ControllerBase
{
    public $organisation_id ="";
    public $db_name="";

    protected function initialize()
    {
        \Phalcon\Tag::prependTitle('PRIME | ');
        $this->view->setViewsDir('../app/views/');
        $this->view->setLayoutsDir('/layouts/');
        $this->view->setTemplateAfter('main');
        
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
            $this->db_name=$auth['db_name'];
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->tag->setDefault("organisation_id", $this->organisation_id);
        
    }


    /**
     * Creates a new Table
     */
    public function createAction()
    {
        $process = new Process();

        $process->name = $this->request->getPost("name");
        $process->parameters="[]";
        $process->organisation_id = $this->request->getPost("organisation_id");

        if (!$process->save()) {
            foreach ($process->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("organisation/index/");
        }

        $this->flash->success("Process was created successfully");

        $this->response->redirect("process/edit/".$process->id);

    }
    
    public function indexAction()
    {   

        $data = Process::find("organisation_id= ".$this->organisation_id);
        
        $this->view->setVar("processes", $data);  


        $data = ProcessScheduled::find("organisation_id= ".$this->organisation_id);
        
        $this->view->setVar("processes_scheduled", $data); 

    } 

    public function editAction($id)
    {

        $process = Process::findFirstById($id);

        $this->view->setVar('process',$process);

        $helpers=array();
        $helpers["AGGREGATION"]="{{username}}";
        $helpers["Menu Items"]="{{menu}}";

        $this->view->setVar("helpers",$helpers);

    }



    public function deleteAction()
    {
        $id = $this->request->getPost("id");
        $process = Process::findFirstByid($id);

        if (!$process->delete()) {

            foreach ($process->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Process was deleted successfully");
        }

        return $this->dispatcher->forward(array(
     "controller" => "process",
     "action" => "index"
 ));
    }

    public function saveAction($id)
    
    {
        $this->view->Disable();
        $process = Process::findFirstById($id);

        $process->name = $this->request->getPost("name");
        $process->parameters = $this->request->getPost("parameters");
        $process->storage = $this->request->getPost("storage");

        if (!$process->save()) {
            foreach ($process->getMessages() as $message) {
                $this->flash->error($message);
            }
        }




    }

    public function getUserDB()
    {
        try{
            $db= new \Crate\PDO\PDO('crate:localhost:4200;', null, null, []); 
        }
        catch(PDOException $ex){
            
            die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
        }
        
        return $db;
    }



}


