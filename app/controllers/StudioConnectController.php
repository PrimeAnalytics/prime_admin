<?php
namespace PRIME\Controllers;
use PRIME\Models\Organisation;
use PRIME\Models\ProcessOperator;
use PRIME\Models\OrgDatabase;

class StudioConnectController extends ControllerBase
{
    public $organisation_id ="";
    public $db_name="";
    protected function initialize()
    {
        $this->view->disable();      
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
            $this->db_name=$auth['db_name'];
        }
    }


    public function ProcessOperatorListAction()
    {

        $process_operators = ProcessOperator::findByorganisation_id($this->organisation_id);
        $temp=array();
        foreach($process_operators as $operator)
        {
            $temp[]=array("id"=>$operator->id,"name"=>$operator->name,"category"=>$operator->category);
        }

        echo json_encode($temp);

    }

    public function ProcessOperatorListFullAction()
    {

        $process_operators = ProcessOperator::findByorganisation_id($this->organisation_id);


        echo json_encode($process_operators->ToArray());

    }


    public function GetProcessOperatorAction($id)
    {
        
        $process_operators = ProcessOperator::findFirstById($id);

        echo json_encode($process_operators,true);

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

    public function DeleteProcessOperatorAction($id)
    {

        $process_operators = ProcessOperator::findFirstById($id);

        if($process_operators->delete())
        {
            echo "The Operator Was Succesfully Removed";
        }
        else
        {
            echo "Oh No, Something Whent Wrong";
        }

    }

    public function getUserDB()
    {
        try{
            $db= new \Crate\PDO\PDO('crate:localhost:4200',null, null, []);    
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
            $sql = "DROP TABLE IF EXISTS ".$this->db_name.".".$table;

            $connection->query($sql);
        }

       $sql = "CREATE TABLE IF NOT EXISTS ".$this->db_name.".".$table." (";

       $columnTypes=array();

       $num_rows=count($data);

       $type_set=false;

       foreach($data[0] as $key=>$column_name)
       {
           $type=gettype($data[$i][$key]);
           if($type!='string')
           {
               $type_set=true;
           }
       }

       if(!$type_set)
       {
           for($i=0;$i<$num_rows;$i++)
           {
               foreach($data[$i] as $key=>$column_name)
               {
                   $type=gettype($data[$i][$key]);

                   if('string'==gettype($data[$i][$key]))
                   {
                       if(is_numeric ($data[$i][$key]))
                       {
                           if ((int) $data[$i][$key] == (double)$data['0'][$key]) 
                           {
                               $type="integer";
                           }
                           else
                           {
                               $type="double";
                           }
                       }
                       else if(strtotime($data[$i][$key])!=false)
                       {
                           $type="date";

                       }
                       else
                       { 
                       }
                   }

                   $columnTypes[$key][$type]=true;

               }
           }

           foreach($columnTypes as $key=>$value)
           {
               if (array_key_exists("string",$value))
               {
                   $columnTypes[$key]="string";
               }
               elseif (array_key_exists("double",$value))
               {
                   $columnTypes[$key]="double";
               }
               elseif (array_key_exists("integer",$value))
               {
                   $columnTypes[$key]="integer";
               }
               elseif (array_key_exists("date",$value))
               {
                   $columnTypes[$key]="date";
               }

           }
       }
       else
       {
           foreach($data[0] as $key=>$column_name)
           {
               $type=gettype($data[0][$key]);
               $columnTypes[$key]=$type;
           }
       
       }

      



           
           foreach($columnTypes as $key=>$type)
           {
            if($type=="integer")
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" int, ";
            }
            elseif($type=="double")
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" double, "; 
            }
            elseif($type=="date")
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" timestamp, "; 
            }
            else
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" string, ";  
            }
        }

        $sql=substr($sql, 0, -2);

        
          $sql=$sql.")";                
        

        $connection->query($sql);
        
        
        $rows=array();



        $headings=array();

        foreach(array_keys ($data['0']) as $key)
        {
          $headings[]=strtolower(str_replace(" ", "_", $key));
        }

        $sql = "INSERT INTO ".$this->db_name.".".$table." (\"".implode ("\",\"" , $headings)."\") VALUES ";
        foreach($data as $row)
        {
            if(count($data['0'])==count($row))
            {
                $temp="";
                foreach($row as $key=>$value)
                {
                    

                    if($columnTypes[$key]=="integer")
                    {
                        if ($value=="")
                        {
                            $value=0;
                        }
                        $temp.= $value." , ";
                    }
                    elseif($columnTypes[$key]=="double")
                    {
                        if ($value=="")
                        {
                            $value=0;
                        }
                        $temp.= $value." , ";
                    }
                    elseif($columnTypes[$key]=="date")
                    {
                        if ($value=="")
                        {
                            $value=0;
                        }
                        $temp.= "".(strtotime($value)*1000)." , ";
                    }
                    else
                    {
                        if ($value=="")
                        {
                            $temp.= "NULL , ";

                        }
                        else
                        {
                            $temp.= "'".addslashes ($value)."' , ";
                        }
                    }
 
                }
                $temp=substr($temp, 0, -2);
                $rows[]="(".$temp.")";
            }
        }

         $sql=$sql.implode (", " , $rows)." ON DUPLICATE KEY UPDATE ";

        $duplicate_values=array();

        foreach($data['0'] as $column_name=>$values)
        {
            $duplicate_values[]="\"".strtolower(str_replace(" ", "_", $column_name))."\" =VALUES(\"".strtolower(str_replace(" ", "_", $column_name))."\")";        
        }

       $sql=$sql.implode (" ," , $duplicate_values)."";


        if($error=$connection->query($sql))
        {
         
            echo "success";
         
        }
        else
        {
            $errors = $connection->errorInfo();
            print_r($errors[2]);
            return $data_out=null;
        }




    }
    
}
