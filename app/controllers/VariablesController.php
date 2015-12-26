<?php
namespace PRIME\Controllers;
use PRIME\Models\Variables;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;

class VariablesController extends ControllerBase
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
        $variables = new Variables();

        $variables->name = $this->request->getPost("name");
        $variables->values = $this->request->getPost("values");
        $variables->default_value = "";

        $variables->organisation_id = $this->request->getPost("organisation_id");

        if (!$variables->save()) {
            foreach ($variables->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
    "controller" => "dashboard",
    "action" => "index"
));
        }

        $this->flash->success("Link was created successfully");

        return $this->dispatcher->forward(array(
    "controller" => "dashboard",
    "action" => "index"
));

    }
    

    public function editAction($id)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $variables = Variables::findFirstByid($id);  
        
        $this->tag->setDefault("name", $variables->name);
        $this->tag->setDefault("id", $variables->id);
        $this->tag->setDefault("values", $variables->values);
        $this->tag->setDefault("default_value", $variables->default_value);
        $this->tag->setDefault("organisation_id", $variables->organisation_id);


    }


    public function saveAction()
    {
        $variables = Variables::findFirstByid($this->request->getPost("id")); 

        $variables->name = $this->request->getPost("name");
        $variables->values = $this->request->getPost("values");
        $variables->default_value = $this->request->getPost("default_value");

        $variables->organisation_id = $this->request->getPost("organisation_id");

        if (!$variables->save()) {
            foreach ($variables->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
    "controller" => "dashboard",
    "action" => "index"
));
        }

        $this->flash->success("Link was created successfully");

        return $this->dispatcher->forward(array(
    "controller" => "dashboard",
    "action" => "index"
));

    }
    

    
    
    public function deleteAction()
    {
        $id = $this->request->getPost("id");
        $variables = Variables::findFirstByid($id);

        if (!$variables->delete()) {

            foreach ($variables->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Link was deleted successfully");
        }

        return $this->dispatcher->forward(array(
     "controller" => "dashboard",
     "action" => "index"
 ));
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

    public function getListAction()
    {
    $this->view->disable();
    $variables = Variables::findByorganisation_id($this->organisation_id);
    
    $json = array();
    foreach($variables as $variable)
    {
        
        $json[] = array(
                'id' => $variable->id,
                           'text' => $variable->name
                         );
    }
    
    echo json_encode($json);
    }
   
}
