<?php
namespace PRIME\Controllers;
use PRIME\Models\Process;
use PRIME\Models\ProcessScheduled;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;
use \YaLinqo\Enumerable as E;

class ProcessController extends ControllerBase
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
        $auth = $this->session->get("auth");

        $database = OrgDatabase::findFirstByorganisation_id($auth['organisation_id']);
        
        $host= $database->db_host; 
        $mySqlUser= $database->db_username;          
        $mySqlPassword=$database->db_password;      
        $mySqlDatabase=$database->db_name;

        try{
            $db= new \Crate\PDO\PDO('crate:localhost:4200;', null, null, []);    
        }
        catch(PDOException $ex){
            
            die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
        }
        
        return $db;
    }

    public function getHeadersAction($id)
    {
        $this->view->disable();
        
        $array=$this->getResults($id);

        $headers=array();
        foreach($array[0] as $key=>$value){
            $temp=array();

            $temp['id']= $key;
            $temp['text']= $key;

            $headers[]=$temp;

        }

        echo json_encode($headers);
    }

    public function getProcessesAction()
    {
        $this->view->disable();
        
            $auth = $this->session->get("auth");

            
            $organisation = Organisation::findFirstByid($auth['organisation_id']);   
            $processes = $organisation->Process;
            
            $json = array();
            foreach($processes as $process)
            {
                $json[] = array(
                        'id' => $process->id,
                                   'text' => $process->name
                                 );
            }
            
            echo json_encode($json);
            
    }

    public function getResults($id,$links=null)
    {

       $process = Process::findFirstById($id);

       $parameters= json_decode($process->parameters,true);

       $db_table_name=$parameters['table'];

       $db=$this->getUserDB();

       $filter=array();
       $filter_string="";

       if($links!=null)
       {

       $statement = $db->prepare("select column_name from information_schema.columns where schema_name = 'doc' and table_name ='$db_table_name'");
       $statement->execute();

       while($row = $statement->fetch(\PDO::FETCH_ASSOC))
       {	
          
          foreach($links as $link)
          {
              
             if($row['column_name']==$link['column'])
             {
            
                 $filter['keys'][]=$row['column_name'];
                 $filter['values'][]=explode(",",$link['default_value']);
             
             }
          }
       }



       for($i=0;$i<count($filter['keys']);$i++)
       {
           if($i==0)
           {
               $filter_string=" WHERE ".$filter['keys'][$i]." in ('".implode("','",$filter['values'][$i])."') ";
           }
           else
           {
               
               $filter_string=" AND ".$filter['keys'][$i]." in ('".implode("','",$filter['values'][$i])."') ";
               
           }
       }
       
       }

      

       $row_limit=100;
       $data_out=array();

       $selects=array();

       if(!empty( $parameters['columns'] ))
       {

           $parameters['columns']= explode(',',$parameters['columns']);

           foreach($parameters['columns'] as $column)
           {
               $temp = str_replace(":"," AS ",$column);
               $temp = str_replace(";",",",$temp);
               $selects[] = $temp;
           }

           $select_string= $selects;
       }
       else
       {
           $select_string=array();
       
       }


       $additional_selects =array();

       if(!empty( $parameters['rows'] ))
       {
           $parameters['rows']= explode(',',$parameters['rows']);

           $groups=array();

           foreach($parameters['rows'] as $row)
           { 
               $temp = str_replace(":"," AS ",$row);
               $temp = str_replace(";"," , ",$temp);

               $additional_selects[] =$temp;

               if (strpos($row,':') !== false) {

                   $groups[] =  explode(':',$row)[1];

               }
               else
               {
                   $groups[] = $temp;
               }
           }

           $group_string= ' GROUP BY '.implode(" , ",$groups);
           $order_string= ' ORDER BY '.implode(" , ",$groups);
           //$additional_selects=implode(" , ",$additional_selects);
       }
       else{
           $order_string="";
           $group_string="";
           $additional_selects=array();
       }

       $select_string=implode(" , ", array_merge($additional_selects,$select_string));

       if($select_string== "")
       {
           $select_string= "*";
       }

       $sql="SELECT $select_string FROM doc.$db_table_name $filter_string $group_string $order_string Limit $row_limit";
     
       $statement=$db->prepare( $sql);
            
                   if($error=$statement->execute())
                   {
                       
                       foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row)
                       {
                           foreach($row as $sub_key=>$sub_value)
                           {
                               $floatVal = floatval($sub_value);
                               
                               if($sub_value=="")
                               {
                                   $row[$sub_key]="0";
                               }
                               else if(ctype_digit($sub_value))
                               {
                                   $row[$sub_key] = round($sub_value, 2, PHP_ROUND_HALF_DOWN);
                               }
                           }
                           $data_out[]= $row;
                       }
                       return $data_out;
                   }
                   else
                   {
                       $errors = $statement->errorInfo();
                       var_dump($errors[2]);
                       return $data_out=null;
                   }

                   
                   

    }


    function joinArrays($left,$right,$join)
    {
        foreach($left as $key=>$value)
        {
            $join_str="";
            foreach($join as $str)
            {
                $join_str= $join_str.$value[$str];
            }
            $left[$key]['join']=$join_str; 
        }


        foreach($right as $key=>$value)
        {
            $join_str="";
            foreach($join as $str)
            {
                $join_str= $join_str.$value[$str];
            }
            $right[$key]['join']=$join_str; 
        }


        $result=array();

        foreach($right as $value)
        {
            $key=true;

            while ($key!==false) 
            { 
                $key = array_search($value['join'], array_column($left, 'join'));
                if($key!==false)
                {
                    $result[]=array_merge ($left[$key],$value);
                    array_splice($left, $key, 1);
                }
            }
        }
    
        return $result;
    
    }

    public function resultTableAction($id){

        $this->view->Disable();

        $array=$this->getResults($id);
            // start table

        $html = '<table class="table table-hover"><thead>';

            // header row

            $html .= '<tr>';

            foreach($array[0] as $key=>$value){

                    $html .= '<th>' . $key . '</th>';

                }

            $html .= '</tr></thead><tbody>';

            // data rows

            foreach( $array as $key=>$value){

                $html .= '<tr>';

                foreach($value as $key2=>$value2){

                    $html .= '<td>' . $value2 . '</td>';

                }

                $html .= '</tr>';

            }

            // finish table and return it

            $html .= '</tbody></table>';

            echo $html;

        }


    public function importAction()
    {

        $fp = fopen("C:\Fund Performance data.csv", "r");
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $num = count($data);
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
        }
        fclose($fp);

    }

}


