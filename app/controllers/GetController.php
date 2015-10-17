<?php
namespace PRIME\Controllers;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;

class GetController extends ControllerBase
{
    public $organisation_id ="";
    protected function initialize()
    {
        $this->view->disable();      
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
        }
    }


    public function getUserDB()
    {
        $database = OrgDatabase::findFirstByorganisation_id($this->organisation_id);
        
        $host= $database->db_host; 
        $mySqlUser= $database->db_username;          
        $mySqlPassword=$database->db_password;      
        $mySqlDatabase=$database->db_name;

        try{
            $db= new \Crate\PDO\PDO('crate:localhost:4200', $host, null, []);    
        }
        catch(PDOException $ex){
            
            die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
        }
        
        return $db;
    }

    public function DBColumnsAction($db_table)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $statement = $db->prepare("select column_name from information_schema.columns where schema_name = 'db_prime' and table_name ='$db_table'");
        $statement->execute();
        
        $json = array();
        
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
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

    public function DBTablesAction()
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $statement=$db->prepare("select table_name from information_schema.tables where schema_name='db_prime' limit 100");
        
        $statement->execute();
        
        $json = array();
        
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
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
