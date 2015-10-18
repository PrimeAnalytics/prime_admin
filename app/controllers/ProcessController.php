<?php
namespace PRIME\Controllers;
use PRIME\Models\Process;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;

class ProcessController extends ControllerBase
{
    public $organisation_id ="";
    protected function initialise()
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


    /**
     * Creates a new dashboard
     */
    public function createAction()
    {
        $process = new Process();

        $process->name = $this->request->getPost("name");
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

        $processes = Process::find();
        $this->view->setVar("processes", $processes);  
        
    } 

    public function editAction($id)
    {

        $process = Process::findFirstById($id);

        $this->view->setVar('process',$process);


    }

    public function saveAction($id)
    
    {
        $process = Process::findFirstById($id);

        $process->name = $this->request->getPost("name");
        $process->xml = $this->request->getPost("xml");
        $process->parameters = $this->request->getPost("parameters");
        $process->storage = $this->request->getPost("storage");

        if (!$process->save()) {
            foreach ($process->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("organisation/index/");
        }

        $this->flash->success("Process was saved successfully");

        $this->response->redirect("process/edit/".$process->id);


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
        
        if ($this->session->has("auth")) {
            //Retrieve its value
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
    }

    public function getResults($id,$links=null)
    {
        $process = Process::findFirstById($id);

       $parameters= json_decode($process->parameters,true);

       $db=$this->getUserDB();

       $row_limit=200;
       $data_out=array();

       $selects=array();

       foreach($parameters['columns'] as &$column)
       {
       
           $selects[] = $column['aggregation']."(".$column['column'].") AS ".$column['name']."";
       
       }

       $select_string= implode(" , ",$selects);

       $group_string= ' GROUP BY '.implode(" , ",$parameters['group']);

       $order_string= ' ORDER BY '.implode(" , ",$parameters['order']);

       $db_table_name=$parameters['table'];

      
       $statement=$db->prepare("SELECT ".implode(" , ",$parameters['group']).", $select_string FROM db_prime.$db_table_name $group_string $order_string Limit $row_limit");
            
                   if($statement->execute())
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
                   }


              return $data_out;

    }

    public function resultTableAction($id){

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

}


