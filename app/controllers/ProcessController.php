<?php
namespace PRIME\Controllers;
use PRIME\Models\Process;

class ProcessController extends ControllerBase
{
    protected function initialize()
    {
        \Phalcon\Tag::prependTitle('PRIME | ');
        $this->view->setViewsDir('../app/views/');
        $this->view->setLayoutsDir('/layouts/');
        $this->view->setTemplateAfter('main');
    }
    
    public function indexAction()
    {   

        $processes = Process::find();
        $this->view->setVar("processes", $processes);  
        
    } 

    public function newAction()
    {
    }

    public function editAction($id)
    {
        


    }

    
    
    
}
