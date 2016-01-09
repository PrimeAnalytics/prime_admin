<?php
namespace PRIME\Controllers;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Variables;

class GetController extends ControllerBase
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


    public static function getDashboardList()
    {
        $theme = $_SESSION["auth"]['theme'];

        $data=array();

        $subdirectory = '../app/themes/'.$theme.'/dashboards/';
        //get all files in specified directory
        $subfiles = glob($subdirectory."*.{php}", GLOB_BRACE);
        foreach($subfiles as $subfile)
        {
            $type = str_replace("Controller.php","",basename($subfile));
            $name = trim(implode(' ', preg_split('/(?=\p{Lu})/u', $type)));
            $data[]=$name;

        }

        return $data;
    }

    public static function getLoginList()
    {
        $theme = $_SESSION["auth"]['theme'];

        $data=array();

        $subdirectory = '../app/themes/'.$theme.'/logins/';
        //get all files in specified directory
        $subfiles = glob($subdirectory."*.{php}", GLOB_BRACE);
        foreach($subfiles as $subfile)
        {
            $type = str_replace("Controller.php","",basename($subfile));
            $name = trim(implode(' ', preg_split('/(?=\p{Lu})/u', $type)));
            $data[]=$name;

        }

        return $data;
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

    public function DBColumnsAction($db_table,$return=false)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $statement = $db->prepare("select column_name, data_type from information_schema.columns where schema_name = '".strtolower($this->db_name)."' and table_name ='$db_table'");
        $statement->execute();
        
        $json = array();
        
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {		                
                $json[] = array(
                    'id'=> $row['column_name'],
              'text' => $row['column_name'],
              'type' => $row['data_type']
            );

        }                                  
        if ($return == true) {
            echo json_encode($json);
        }

            return $json;
      
    }

    public function DBTableDataAction($db_table)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $statement = $db->prepare("select * from ".strtolower($this->db_name).".$db_table Limit 100000");
        $statement->execute();
        
        $json = array();
        
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {		
            $json[] =$row;
        }                                  

            echo json_encode($json);

        return $json;
        
    }

    public function DBTableRecordCountAction($db_table)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $statement = $db->prepare("select count(*) from ".strtolower($this->db_name).".$db_table Limit 100000");
        $statement->execute();
        
        $json = array();
        
        while($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {		
            $json =$row['count(*)'];
        }                                  

        echo json_encode($json);

        return $json;
        
    }

    public function VariablesAction($return=true)
    {
        $this->view->disable();
        $variables = Variables::findByorganisation_id($this->organisation_id);
        
        $json = array();
        foreach($variables as $variable)
        {
            
            $json[] = array(
                    'id' => $variable->id,
                               'text' => '{'.$variable->name.'}',
                               'type'=> 'numeric'
                              
                             );
        }
        
        if ($return == true) {
            echo json_encode($json);
        }

        return $json;
    }

    public function DBTablesAction($return=true)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $statement=$db->prepare("select table_name from information_schema.tables where schema_name='".strtolower($this->db_name)."' limit 100");
       

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
        
        if ($return) {
            echo json_encode($json);
        }

        return $json;
    }


    public function autocompleteAction($for_input_type,$table=null)
    {
        if($table==null)
        {
            $tables=$this->DBTablesAction(false);
            $data=array();
            foreach($tables as $tabl)
            {
                $data=array_merge($data,$this->DBColumnsAction($tabl['id']));
            }
        }
        else
        {
            $data=$this->DBColumnsAction($table);
            $data=array_merge($data,$this->VariablesAction(false));

        }
        $output=array();

        foreach($data as $column)
        {
            $type=$column['type'];
            $column=$column['text'];
            if($type=='integer' ||  $type=='long'|| $type=='short'||$type=='double'||$type=='float'||$type=='byte')
            {
                $type='numeric';
            }

            if($type=='numeric' && $for_input_type =='columns')
            {
                $output['time_number'][]='sum('.$column.')';
                $output['time_number'][]='avg('.$column.')';
                $output['time_number'][]='geometric_mean('.$column.')';
                $output['time_number'][]='variance('.$column.')';
                $output['time_number'][]='stddev('.$column.')';
            }
            if($type=='numeric')
            {
                $output['number'][]='abs('.$column.')';
                $output['number'][]='ceil('.$column.')';
                $output['number'][]='floor('.$column.')';
                $output['number'][]='ln('.$column.')';
                $output['number'][]='log('.$column.')';
                $output['number'][]='round('.$column.')';
                $output['number'][]='sqrt('.$column.')';
            }
            if($type=='timestamp')
            {

                $output['time'][]='date_format('.$column.')';


            }

            if(($type=='numeric' || $type=='timestamp'|| $type=='string') && $for_input_type =='columns')
            {

                $output['time_number_string'][]='min('.$column.')';
                $output['time_number_string'][]='max('.$column.')';

            }

            $output['column_name'][]=$column;

            if($for_input_type =='columns')
            {
                $output['all'][]='count('.$column.')';
                $output['all'][]='count(distinct '.$column.')';
                $output['all'][]='arbitrary('.$column.')';
            }
        }

        if($for_input_type =='columns')
        {
            $output['none'][]='count(*)';
            $output['none'][]='random()';
            $output['none'][]='CURRENT_TIMESTAMP';
        }

        $output['set'][]='concat()';
        $output['set'][]='total{}';
        $output['set'][]='format()';
        $output['set'][]='substr()';
        $output['set'][]='regexp_matches()';
        $output['set'][]='regexp_replace()';
        $output['set'][]='date_trunc()';
        $output['set'][]='extract()';
        $output['set'][]='distance()';
        $output['set'][]='within()';

        function array_flatten($array) { 
            if (!is_array($array)) { 
                return FALSE; 
            } 
            $result = array(); 
            foreach ($array as $key => $value) { 
                if (is_array($value)) { 
                    $result = array_merge($result, array_flatten($value)); 
                } 
                else { 
                    $result[$key] = $value; 
                } 
            } 
            return $result; 
        } 

        $output=array_flatten($output);

        echo json_encode($output);
    }





    
    
    
}
