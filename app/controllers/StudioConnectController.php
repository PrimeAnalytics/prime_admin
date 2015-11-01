<?php
namespace PRIME\Controllers;
use PRIME\Models\Organisation;
use PRIME\Models\ProcessOperator;
use PRIME\Models\OrgDatabase;

class StudioConnectController extends ControllerBase
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


    public function ProcessOperatorListAction($accessibility)
    {

        $process_operators = ProcessOperator::findByorganisation_id($this->organisation_id);
        
       echo json_encode($process_operators->toArray());

    }


    public function NewProcessOperatorAction()
    {

        $process_operators = new ProcessOperator();

        $process_operators->organisation_id=$this->organisation_id;
        $process_operators->name = $this->request->getPost("name");
        $process_operators->description= $this->request->getPost("description");
        $process_operators->category= $this->request->getPost("category");
        $process_operators->form= $this->request->getPost("form");
        $process_operators->script= $this->request->getPost("script");
        $process_operators->assemblies= $this->request->getPost("assemblies");
        $process_operators->secondary_script= $this->request->getPost("secondary_script");
        $process_operators->accessibility= $this->request->getPost("accessibility");
        $process_operators->icon= $this->request->getPost("icon");

        if($process_operators->save())
        {
            echo "The Operator Was Succesfully Uploaded";
        }
        else
        {
            echo "Oh No, Something Whent Wrong";
        }

    }

    public function SaveProcessOperatorAction($id)
    {

        $process_operators = ProcessOperator::findFirstById($id);

        $process_operators->name = $this->request->getPost("name");
        $process_operators->description= $this->request->getPost("description");
        $process_operators->category= $this->request->getPost("category");
        $process_operators->form= $this->request->getPost("form");
        $process_operators->script= $this->request->getPost("script");
        $process_operators->assemblies= $this->request->getPost("assemblies");
        $process_operators->secondary_script= $this->request->getPost("secondary_script");
        $process_operators->accessibility= $this->request->getPost("accessibility");
        $process_operators->icon= $this->request->getPost("icon");

        if($process_operators->save())
        {
            echo "The Operator Was Succesfully Uploaded";
        }
        else
        {
            echo "Oh No, Something Whent Wrong";
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

    public function UploadDataAction($table,$queryType="update")
    {
        ini_set('max_execution_time', 3600);
        $this->view->disable();

        $data=json_decode($this->request->getPost('data'),true);

        $this->writeDatabase($table,$data,$queryType);
        
    }



    public function writeDatabase($table,$data,$queryType="update")
    {

        
        $this->view->disable();
        $connection = $this->getUserDB();

        if($queryType=="override")
        {
            $sql = "DROP TABLE IF EXISTS ".$table;

            $connection->query($sql);
        }

       $sql = "CREATE TABLE IF NOT EXISTS ".$table." (";

       $columnTypes=array();
        foreach($data['0'] as $key=>$column_name)
        {
            $type=gettype($data['0'][$key]);

            if('string'==gettype($data['0'][$key]))
            {
                if(is_numeric ($data['0'][$key]))
                {
                    if ((int) $data['0'][$key] == (double)$data['0'][$key]) 
                    {
                        $type="integer";

                    }
                    else
                    {
                        $type="double";
                    }
                }
                else if(strtotime($data['0'][$key])!=false)
                {
                    $type="date";

                }
                else
                { 
                }
            }

            $columnTypes[$key]=$type;

            if($type=="integer")
            {
                $sql=$sql."".$key." int, ";
            }
            elseif($type=="double")
            {
                $sql=$sql."".$key." double, "; 
            }
            elseif($type=="date")
            {
                $sql=$sql."".$key." timestamp, "; 
            }
            else
            {
                $sql=$sql."".$key." string, ";  
            }
        }

        $sql=substr($sql, 0, -2);

        //if($primary_key=="auto")
        //{
        //    $sql=$sql."id INT PRIMARY KEY";
        //}
        //elseif($primary_key=="first")
        //{
        //    $sql=$sql."PRIMARY KEY (".reset($data['headings']).")";
        //}
        //else
        //{
        //    $sql=$sql."PRIMARY KEY (".$primary_key.")";
        //}
        
         $sql=$sql.")";                
        

        $connection->query($sql);
        
        
        $rows=array();

        $sql = "INSERT INTO ".$table." (".implode ("," , array_keys ($data['0'])).") VALUES ";
        foreach($data as $row)
        {
            if(count($data['0'])==count($row))
            {
                $temp="";
                foreach($row as $key=>$value)
                {
                    

                    if($columnTypes[$key]=="integer")
                    {
                        $temp.= $value." , ";
                    }
                    elseif($columnTypes[$key]=="double")
                    {
                        $temp.= $value." , ";
                    }
                    elseif($columnTypes[$key]=="date")
                    {
                        $temp.= "".strtotime($value)." , ";
                    }
                    else
                    {
                        $temp.= "'".addslashes ($value)."' , ";
                    }
 
                }
                $temp=substr($temp, 0, -2);
                $rows[]="(".$temp.")";
            }
        }

        array_shift($rows);

         $sql=$sql.implode (", " , $rows)." ON DUPLICATE KEY UPDATE ";

        $duplicate_values=array();

        foreach($data['0'] as $column_name=>$values)
        {
            $duplicate_values[]="".$column_name." =VALUES(".$column_name.")";        
        }

      echo $sql=$sql.implode (" ," , $duplicate_values)."";

        $connection->query($sql);

    }
    
}
