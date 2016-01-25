<?php
namespace PRIME\Controllers;
use PRIME\Models\Process;
use PRIME\Models\ProcessScheduled;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;

class DatabaseExplorerController extends ControllerBase
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

    public function editAction($db_table,$page=1)
    {
        
        $db = $this->getUserDB();
        $statement = $db->prepare("select * from ".strtolower($this->db_name).".$db_table Limit 25");
        $statement->execute();
        
        $data = array();
        
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {		
            $data[] = $row;
        }   

        $this->view->setVar('table_name',$db_table);
        
        $this->view->setVar('data',$data);

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

    }


    public function deleteTableAction($db_table)
    {
        
        $db = $this->getUserDB();
        $statement = $db->prepare("DROP TABLE IF EXISTS ".strtolower($this->db_name).".$db_table");
        $statement->execute();
        
    }

    public function indexAction()
    {
        $db = $this->getUserDB();
        $statement=$db->prepare("select table_name from information_schema.tables where schema_name='".strtolower($this->db_name)."' limit 100");
        
        $statement->execute();
        
        $tables = array();
        
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {		
            $tables[] = $row;
        }   


        $this->view->setVar('tables',$tables);
    }

        public function getUserDB()
    {
        try{
            $db= new \Crate\PDO\PDO('crate:localhost:4200', null, null, []);    
        }
        catch(PDOException $ex){
            
            die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
        }
        
        return $db;
    }





}


