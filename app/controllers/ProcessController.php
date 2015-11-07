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

            $organisation = Organisation::findFirstByid($this->organisation_id);   
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
        $auth = $this->session->get("auth");
        $this->db_name=$auth['db_name'];
       
       $process = Process::findFirstById($id);

       $parameters= json_decode($process->parameters,true);

       $db_table_name=$parameters['table'];

       $db=$this->getUserDB();

       $filter=array();
       $filter_string="";
       $having_string="";


       if($links!=null)
       {

               foreach($links as $link)
               {
                   
                   if($db_table_name==$link['table'])
                   {
                       
                       $filter['keys'][]=str_replace("|",",",$link['column']);
                       $filter['values'][]=(array)$link['default_value'];
                       $filter['operator'][]=$link['operator'];
                       $filter['type'][]=$link['type'];

                   }
               }


           $having=0;
           $where=0;
           for($i=0;$i<count($filter['keys']);$i++)
           {
               if($filter['type'][$i]=="where")
               {
                   for($j=0;$j<count($filter['values'][$i]);$j++)
                   {
                       if($filter['values'][$i][$j]!='')
                       {
                           if($where==0)
                           {
                               $filter_string.=" WHERE (".$filter['keys'][$i]." ".$filter['operator'][$i]." '".addslashes($filter['values'][$i][$j])."' ";
                               $where++;
                           }
                           else if($j==0)
                           {
                               $filter_string.=") AND (".$filter['keys'][$i]." ".$filter['operator'][$i]." '".addslashes($filter['values'][$i][$j])."' ";
                           }
                           else
                           {
                               $filter_string.=" OR ".$filter['keys'][$i]." ".$filter['operator'][$i]." '".addslashes($filter['values'][$i][$j])."' ";
                           }
                       }
                   }
                   
               }
               else if($filter['type'][$i]=="having")
               {

                   for($j=0;$j<count($filter['values'][$i]);$j++)
                   {
                       if($having==0 && $filter['values'][$i][$j]!='')
                       {
                           $having_string.=" HAVING ".$filter['keys'][$i]." ".$filter['operator'][$i]." ".addslashes($filter['values'][$i][$j])." ";
                           $where++;
                       }
                       else if($j==0)
                       {
                           $having_string.=" AND ".$filter['keys'][$i]." ".$filter['operator'][$i]." ".addslashes($filter['values'][$i][$j])." ";
                       }
                       else
                       {
                           $having_string.=" OR ".$filter['keys'][$i]." ".$filter['operator'][$i]." ".addslashes($filter['values'][$i][$j])." ";
                       }

                   }
               }


           }

              if($where!=0)
               {
                   $filter_string.=") ";
               }
           
       }
       $matches;

       if(!empty( $parameters['columns'] )||!empty( $parameters['rows'] ))
       {
           $temp = str_replace(":"," AS ",$parameters['columns']);
           $temp = str_replace("|",",",$temp);

           preg_match_all('/total{(.*?)}/',$temp, $matches);

           $temp = str_replace(":"," AS ",$parameters['rows']);
           $temp = str_replace("|",",",$temp);

           preg_match_all('/total{(.*?)}/',$temp, $matches2);

          $matches[0]= array_merge($matches[0],$matches2[0]);
          $matches[1]= array_merge($matches[1],$matches2[1]);

         $matches[0]=array_unique ($matches[0]);
         $matches[1]=array_unique ($matches[1]);

         if(count($matches[0])!=0)
         {
             
           $sql_totals="SELECT ".implode(" , ",$matches[1])." FROM ".$this->db_name.".$db_table_name $filter_string";

             $statement=$db->prepare($sql_totals);
             if($error=$statement->execute())
             {
                 $i=0;
                 $results_temp=$statement->fetchAll(\PDO::FETCH_ASSOC)[0];
                 foreach($results_temp as $sub_key=>$sub_value)
                 {
                     $matches[2][]=$sub_value;
                     
                     $i++;
                 }
             }

             $matches = array_map('array_values', $matches);
             
         }
       }

      

       $row_limit=1000;
       $data_out=array();

       $selects=array();

       if(!empty( $parameters['columns'] ))
       {

           $parameters['columns']= explode(',',$parameters['columns']);

           foreach($parameters['columns'] as $column)
           {
               $formula=str_replace("|",",",$column);
               if (isset($matches))
               {
               for($i=0;$i<count($matches[0]);$i++)
               {
                   $formula=str_replace($matches[0][$i],$matches[2][$i],$formula);
               }
               }
                   if (strpos($column,':') !== false) {
                       $temp = str_replace(":"," AS \"",$formula)."\"";
                   }
                   else
                   {
                       $temp=$formula." AS \"".$column."\"";
                   }
             
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
               
               $formula=str_replace("|",",",$row);
               if (isset($matches))
               {
                   for($i=0;$i<count($matches[0]);$i++)
                   {
                       $formula=str_replace($matches[0][$i],$matches[2][$i],$formula);
                   }
               }
               if (strpos($row,':') !== false) {
                   $temp = str_replace(":"," AS \"",$formula)."\"";
               }
               else
               {
                   $temp=$formula." AS \"".$row."\"";
               }

               $additional_selects[] =$temp;

               $groups[] =  explode(' AS ',$temp)[1];

   
           }

           $group_string= ' GROUP BY '.implode(" , ",$groups);
           $order_string= ' ORDER BY '.implode(" , ",$groups);
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


       $sql="SELECT $select_string FROM ".$this->db_name.".$db_table_name $filter_string $group_string $having_string $order_string Limit $row_limit";
     
       $statement=$db->prepare( $sql);
            
                   if($error=$statement->execute())
                   {
                       
                       foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row)
                       {
                           foreach($row as $sub_key=>$sub_value)
                           {
     
                               if(gettype ($sub_value)=='string')
                               {
                                   $row[$sub_key]="".$sub_value."";
                               }
                               elseif(gettype ($sub_value)=='double')
                               {
                                   $row[$sub_key] = round($sub_value, 2, PHP_ROUND_HALF_DOWN);
                               }
                               elseif($sub_value=="")
                               {
                                   $row[$sub_key]="0";
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

        if(count($array)!=0)
        {
            // start table

            $html = '
                <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="icon-bulb"></i> <strong>Filtering </strong> with <strong>Select</strong> Inputs in <strong>Footer</strong></h3>
                </div>
                <div class="panel-content"><table id="resultTable" class="table table-hover"><thead>';

            // header row

            $html .= '<tr>';

            foreach($array[0] as $key=>$value){

                $html .= '<th>' . $key . '</th>';

            }

            $html .= '</tr></thead><tfoot>';

            // header row

            $html .= '<tr>';

            foreach($array[0] as $key=>$value){

                $html .= '<th>' . $key . '</th>';

            }

            $html .= '</tr></tfoot><tbody>';


            // data rows

            foreach( $array as $key=>$value){

                $html .= '<tr>';

                foreach($value as $key2=>$value2){

                    $html .= '<td>' . $value2 . '</td>';

                }

                $html .= '</tr>';

            }

            // finish table and return it

            $html .= '</tbody></table></div></div>';

            echo $html;

            echo '<script>
                $(\'#resultTable\').DataTable( {
                    initComplete: function () {
                        var api = this.api();
             
                        api.columns().indexes().flatten().each( function ( i ) {
                            var column = api.column( i );
                            var select = $(\'<select class="form-control" data-placeholder="Select to filter"><option value=""></option></select>\')
                                .appendTo( $(column.footer()).empty() )
                                .on( \'change\', function () {
                                    var val = $(this).val();
             
                                    column
                                        .search( val ? \'^\'+val+\'$\' : \'\', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( \'<option value="\'+d+\'">\'+d+\'</option>\' )
                            } );
                        } );
                    }
                } );
</script>';


     

        }

        }

}


