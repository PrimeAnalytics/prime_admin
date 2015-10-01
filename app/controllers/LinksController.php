<?php
namespace PRIME\Controllers;
use PRIME\Models\Links;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;

class LinksController extends ControllerBase
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
    public function newAction($organisation_id)
    {
        $organisation = Organisation::findFirstByid($organisation_id);   

        $this->tag->setDefault("organisation_id", $organisation_id);
        
        $this->view->setTemplateAfter('');
    }

    public function getUserDB()
    {
        $database = OrgDatabase::findFirstByorganisation_id($this->organisation_id);
        
        $host= $database->db_host; 
        $mySqlUser= $database->db_username;          
        $mySqlPassword=$database->db_password;      
        $mySqlDatabase=$database->db_name;
        
        try{
            $db= new \PDO("mysql:dbname=$mySqlDatabase;host=$host;",$mySqlUser,$mySqlPassword,array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));    
        }
        catch(PDOException $ex){
            
            die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
        }
        
        return $db;
    }

    /**
     * Creates a new dashboard
     */
    public function createAction()
    {
        $links = new Links();

        $links->name = $this->request->getPost("name");
        $links->table = $this->request->getPost("table");
        $links->column = $this->request->getPost("column");
        $links->default_value = $this->request->getPost("default_value");
        $links->operator = $this->request->getPost("operator");

        $links->organisation_id = $this->request->getPost("organisation_id");

        if (!$links->save()) {
            foreach ($links->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("organisation/index/");
        }

        $this->flash->success("Link was created successfully");

        $this->response->redirect("organisation/index/".$links->organisation_id);

    }
    
    public function indexAction()
    {   

        $processes = Process::find();
        $this->view->setVar("processes", $processes);  
        
    } 

    public function editAction($id)
    {
        


    }

    public function getDBColumnsAction($db_table)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $dbTables = $db->prepare("SHOW COLUMNS FROM `$db_table`");
        $dbTables->execute();
        
        $json = array();
        
        while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
        {		
            $json[] = array(
                'id' => $row['Field'],
                           'text' => $row['Field']
                         );
        }                        
        
        echo json_encode($json);
    }

    public function getDBTablesAction()
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $dbTables = $db->prepare("SHOW TABLES");
        $dbTables->execute();
        
        $json = array();
        
        while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
        {		
            foreach($row as $key=>$value) {
                
                $json[] = array(
                    'id'=> $value,
              'text' => $value
            );
            }
        }                        
        
        echo json_encode($json);
    }

    
    
    
}
