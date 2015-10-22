<?php
namespace PRIME\Controllers;
use PRIME\Models\ProcessScheduled;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;

class ProcessScheduledController extends ControllerBase
{
    public $organisation_id ="";
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
     * Creates a new dashboard
     */
    public function createAction()
    {
        $process_scheduled = new ProcessScheduled();

        $process_scheduled->name = $this->request->getPost("name");
        $process_scheduled->parameters=json_encode($this->request->getPost("parameters"),true);
        $process_scheduled->organisation_id = $this->request->getPost("organisation_id");

        if (!$process_scheduled->save()) {
            foreach ($process_scheduled->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("process/index/");
        }

        $this->flash->success("Scheduled Process was created successfully");

        $this->response->redirect("process_scheduled/edit/".$process_scheduled->id);

    }
    

    public function editAction($id)
    {

        $process_scheduled = ProcessScheduled::findFirstById($id);

        $this->view->setVar('process_scheduled',$process_scheduled);

    }



    public function deleteAction()
    {
        $id = $this->request->getPost("id");
        $process_scheduled = ProcessScheduled::findFirstByid($id);

        if (!$process_scheduled->delete()) {

            foreach ($process_scheduled->getMessages() as $message) {
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
        $process_scheduled = ProcessScheduled::findFirstById($id);

        $process_scheduled->name = $this->request->getPost("name");
        $process_scheduled->parameters = $this->request->getPost("parameters");
        $process_scheduled->storage = $this->request->getPost("storage");

        if (!$process_scheduled->save()) {
            foreach ($process_scheduled->getMessages() as $message) {
                $this->flash->error($message);
            }
        }




    }


    public function getProcessesScheduledAction()
    {
        $this->view->disable();
        
            $auth = $this->session->get("auth");

            
            $organisation = Organisation::findFirstByid($auth['organisation_id']);   
            $process_scheduledes = $organisation->ProcessScheduled;
            
            $json = array();
            foreach($process_scheduledes as $process_scheduled)
            {
                $json[] = array(
                        'id' => $process_scheduled->id,
                                   'text' => $process_scheduled->name
                                 );
            }
            
            echo json_encode($json);
            
    }

}


