<?php
namespace PRIME\DataConnectors;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Organisation;
use PRIME\Models\OrgDatabase;
use PRIME\Models\DataConnector;

class DataConnectorBase extends Controller
{    
    public $icon = "fa-cogs";
    public $connector_name = "";
    public $organisation_id ="";
    public $form_struct='';
    public $authenticator='';
    public $url='';
    public $method='';
    
    /**
     * Displays the creation form
     */    
    public function newAction($organisation_id, $id="")
    {
        $authenticatorName = "\PRIME\Authenticators\\".$this->authenticator."Controller";
        $authenticatorController= new $authenticatorName;

        $authenticatorController->initialize();
        $authenticatorStruct= json_decode($authenticatorController->form_struct, TRUE);

        $this->view->disable();
        $echo_array= array();  
        $header_text = "Create New ". $this->connector_name;
        $icon = $this->icon; 

        $namespace = str_replace('PRIME\DataConnectors\\', '', $this->router->getNamespaceName());
        $form_type = "data_connectors/". strtolower($namespace."/".$this->router->getControllerName())."/create"; 
        
        $type= strtolower($namespace."/".$this->router->getControllerName());
        //references begin

        $echo_array['ref'][]= '
        <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
        ';
        $echo_array['ref'][]='
        <link href="/assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" media="screen"/>
        <script src="/assets/plugins/select2/js/select2.js" type="text/javascript"></script>
        ';

        //references end
        
        
        $struct=$this->form_struct;
        $struct= json_decode($struct,TRUE);
        
        foreach($authenticatorStruct as $key=>$value)
        {
            foreach($value as $subvalue)
            {
                $struct[$key][]=$subvalue;
            }
        }

        //html part start
        
        //modal begin
        
        $echo_array['html']['header'][]='<div class="modal-content">
                '.$this->tag->form($form_type).'
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <br>
                  <i class="fa '.$icon.' fa-7x"></i>
                  <h4 id="myModalLabel" class="semi-bold">'.$header_text.'</h4>
                  <p class="no-margin">Please provide all the required information. </p>
                  <br>
             </div>
              <div class="modal-body">';

        if($id!="")
        {
            $echo_array['html']['body'][] = $this->tag->hiddenField(array("id", "value" => $id));
        }
        
        $echo_array['html']['body'][] = $this->tag->hiddenField(array("type", "value" => $type));
        $echo_array['html']['body'][] = $this->tag->hiddenField(array("organisation_id", "value" => $organisation_id));

        $echo_array['html']['body'][]= '<h4>Cron Scheduler</h4>
                                        <div class="row form-row" >
                                <div class="col-md-4">
                                <label class="form-label">Days</label>
                                <input type="text" name="parameters[scheduler][day]" style="width:100%" ></input>
                                </div>

                                <div class="col-md-4">
                                <label class="form-label">Hours</label>
                                <input type="text" name="parameters[scheduler][hours]" style="width:100%" ></input>
                                </div>

                                <div class="col-md-4">
                                <label class="form-label">Minutes</label>
                                <input type="text" name="parameters[scheduler][minutes]" style="width:100%" ></input>
                                </div>
                                </div>';  
        
        $echo_array['html']['footer']='
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    '.$this->tag->submitButton(array("Save","class"=>"btn btn-primary")).'
                    </div>
                  </form>
                </div>';
        
        //modal end
        
        //body settings start
        
   
        $echo_array['html']['body']['parm'][]='<h4>Connector Parameters</h4>
                                        <div class="row form-row" >';
        foreach($struct as $key=>$value)
        {

            foreach($value as $parm)
            {
                if($parm['type']== 'input')
                {
                    $echo_array['html']['body'][$key][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <input type="text" name="parameters['.$key.']['.$parm['name'].']" style="width:100%" ></input>
                                </div>';  
                }
                elseif($parm['type']== 'hidden')
                {
                    $echo_array['html']['body'][$key][]= '<input type="hidden" name="parameters['.$key.']['.$parm['name'].']" value="'.$parm['value'].'"></input>';  
                }
                elseif($parm['type']== 'select')
                {
                    $echo_array['html']['body'][$key][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <select name="parameters['.$key.']['.$parm['name'].']" style="width:100%" >';
                    foreach($parm['values'] as $option)
                    {
                        $echo_array['html']['body'][$key][]= '<option value="'.$option['id'].'" >'.$option['value'].'</$option>';
                    };      
                    $echo_array['html']['body'][$key][]= '</select>
                                </div>';
                } 
  
            } 

            
        }
        $echo_array['html']['body'][$key][] = '</div>';   
        
        
        
        //body settings end
        
        
       
        // html part end
        
        
        // script part start
        
        $echo_array['script'][]='<script>';
        
        
        $echo_array['script'][]='</script>';
        
        
        function echo_func($data)
        {
            foreach($data as $result)
            {
                if (is_array ($result))
                {
                    
                    echo_func($result);
                    
                }
                else
                
                {
                    echo $result;
                }
                
            }
            
        }

        echo_func($echo_array);
       
        // script part end

    }
      
    public function createAction()
    {
        if($this->request->getPost("id"))
        {
            $data_connector = DataConnector::findFirstByid($this->request->getPost("id"));
        }
        else
        {
            $data_connector = new DataConnector();
        }
        
        $data_connector->name = $this->request->getPost("name");
        $data_connector->type = $this->request->getPost("type");
        $data_connector->organisation_id = $this->request->getPost("organisation_id");
        
        $data_connector->parameters = json_encode($this->request->getPost("parameters") );
        $data_connector->storage = "";
        

        if (!$data_connector->save()) {
            foreach ($data_connector->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "namespace" => "PRIME\Controllers",
                "controller" => "organisation",
                "action"     => "edit",
                "params"     => array('id' => $data_connector->organisation_id)
                ));
        }

        $this->flash->success("Data Connector was saved successfully");

        return $this->dispatcher->forward(array(
                "namespace" => "PRIME\Controllers",
                "controller" => "organisation",
                "action"     => "edit",
                "params"     => array('id' => $data_connector->organisation_id)
                ));

    }

    public function deleteAction($data_connector_id)
    {

        $data_connector = DataConnector::findFirstByid($data_connector_id);
    
        $data_connector->delete();
    
    }

    public function refreshTokenAction($data_connector_id)
    {
        return $this->dispatcher->forward(array(
                "namespace" => "PRIME\Authenticators",
                "controller" => $this->authenticator,
                "action" => "RefreshToken",
                "params" => array($data_connector_id)
            ));
    
    }

    public function getTokenAction($data_connector_id)
    {
        return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Authenticators",
            "controller" => $this->authenticator,
            "action" => "GetToken",
            "params" => array($data_connector_id)
        ));
    
    }

    public function processArrayCollection($collection, $headings)
    {
        
        $results=array();
        foreach($collection as $data)
        {

            $temp=$this->processArray($data, $headings);
            $results['headings']=$temp['headings'];

            foreach($temp as $key=>$row)
            {
               
                if($key!="headings")
                {
                    $results[]=$row;
                }
           
            }

        }
        return $results;
    
    }

    public function processArray($data, $headings)
    {

        $arrayOut=array();
        $headings=json_decode($headings,true);

        $scoring=array();
        
        foreach ($headings as $heading)
        {
            if(is_array($heading))
            {
                $heading=$heading['name'];
            }
            $i=0;
            foreach($data as $key=>$row)
            {
                
                if(in_array($heading,$row))
                {
                    if( array_key_exists ( $key , $scoring ))
                    {
                        $scoring[$key]=$scoring[$key]+1;
                    }
                    else
                    {
                        $scoring[$key]=1;
                    }
                }
                    
                $i++;
            }
        }

        arsort($scoring);
        $score= reset($scoring);
        $row_number_heading = key($scoring);

        if($score!=count($headings))
        {
            
            foreach ($headings as $heading=>$value)
            {
                if(is_array($value))
                {
                    $value=$value['name'];
                }
                $arrayOut['headings'][$value]=$value;
            }

            
        }
        else
        {

            $end_row=count($data)-$row_number_heading+1;

            foreach ($headings as $heading=>$value)
            {
                $parms=array();
                if(is_array($value))
                {
                    $parms=$value;
                    $value=$value['name'];
                }

                $column=array_search($value,$data[$row_number_heading]);

                $arrayOut['headings'][$value]=$data[$row_number_heading][$column];

                $type="unknown";
                
                for($i=$row_number_heading+1;$i<count($data);$i++)
                {
                    if(key_exists("type",$parms))
                    {
                        if($parms['type']=='date')
                        {   
                            if(\DateTime::createFromFormat($parms['format'], $data[$i][$column])!=false)
                            {
                                $type_instance ="date";
                                $arrayOut[$i-$row_number_heading-1][$value]=\DateTime::createFromFormat($parms['format'], $data[$i][$column])->format('Y-m-d');
                            }
                            else
                            {
                                $type_instance ="string";
                                $arrayOut[$i-$row_number_heading-1][$value]=$data[$i][$column];
                            }
                        }

                        else if($parms['type']=='double')
                        {
                            
                            $arrayOut[$i-$row_number_heading-1][$value]=(double)preg_replace("/[^0-9.]/", "", $data[$i][$column]);
                        }
                        else if($parms['type']=='integer')
                        {
                            $arrayOut[$i-$row_number_heading-1][$value]=(int)preg_replace("/[^0-9.]/", "", $data[$i][$column]);
                        }

                    }
                    else
                    {
                        if(is_numeric ($data[$i][$column]))
                        {
                            if ((int) $data[$i][$column] == (double)$data[$i][$column]) 
                            { 
                                $type_instance ="integer";
                                $arrayOut[$i-$row_number_heading-1][$value]=(int)$data[$i][$column];
                            }
                            else
                            {
                                $type_instance ="double";
                                $arrayOut[$i-$row_number_heading-1][$value]=(double)$data[$i][$column];
                            }
                        }
                        else if(strtotime($data[$i][$column])!=false)
                        {
                            $type_instance ="date";
                            $arrayOut[$i-$row_number_heading-1][$value]=strtotime($data[$i][$column]);
                        }
                        else
                        {
                            $type_instance ="string";
                            $arrayOut[$i-$row_number_heading-1][$value]=$data[$i][$column];
                        }
                    }
                    
                    if($type_instance!=$type && $type!="unknown" && ($i-$row_number_heading-1) < $end_row)
                    {
                        $end_row=$i-$row_number_heading-1;
                    }
                    
                    $type=$type_instance;

                }

            }

            $arrayOut = array_slice($arrayOut,0, $end_row+1);
        }

        return $arrayOut;
    
    }


    public function htmlArray($file_content,$tables="all")
	{
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML($file_content);

        $tables = $doc->getElementsByTagName('table');

        $content=array();

        foreach($tables as $table) {
            $content[] = $doc->saveHTML($table); 
        }


        require_once '/assets/php_excel/Classes/PHPExcel/IOFactory.php';

        $file = tempnam(sys_get_temp_dir(), 'pre');
        $Output=array();
        file_put_contents($file.'.html', $content[0]);
        {
            $objPHPExcel = \PHPExcel_IOFactory::load($file.'.html');
            
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

                    ob_start();

                    $objWriter->save('php://output');

                    $Output[] = ob_get_clean();


        }
        unlink($file);//to delete an empty file that tempnam creates
        unlink($file.'.html');//to delete your file

        // var_dump($excelOutput);
        foreach($Output as &$Sheet)
        {

            $data = str_getcsv ( $Sheet,"\n");
            foreach($data as &$row) $row = str_getcsv($row, ",",'"');
            
            $Sheet=$data;

        }

        return $Output;

	}

	public function excelArray($file_content,$sheets="all")
	{
        require_once '/assets/php_excel/Classes/PHPExcel/IOFactory.php';

        $file = tempnam(sys_get_temp_dir(), 'pre');
        $excelOutput=array();
        file_put_contents($file.'.xlsx', $file_content);
        {
            $objPHPExcel = \PHPExcel_IOFactory::load($file.'.xlsx');
            $num=$objPHPExcel->getSheetCount();
            
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

            for($i=0;$i<$num;$i++){

                $objWriter->setSheetIndex($i);
                ob_start();

                $objWriter->save('php://output');

                $excelOutput[] = ob_get_clean();

            }

        }
        unlink($file);//to delete an empty file that tempnam creates
        unlink($file.'.xlsx');//to delete your file

      // var_dump($excelOutput);
        foreach($excelOutput as &$excelSheet)
        {

            $data = str_getcsv ( $excelSheet,"\n");
            foreach($data as &$row) $row = str_getcsv($row, ",",'"');
            
            $excelSheet=$data;

        }

        return $excelOutput;

	}


    public function getResultsAction($data_connector_id, $echo=false)
    {
        $method=$this->method;
        $url =$this->url;
        
        $data_connector = DataConnector::findFirstByid($data_connector_id);
        $parameters=(array)json_decode($data_connector->parameters,true);
        $storage=(array)json_decode($data_connector->storage,true);

		if(array_key_exists('token_expiry',$storage))
		{
        if(time()>$storage['token_expiry'])
        {
            $authenticatorName = "\PRIME\Authenticators\\".$this->authenticator."Controller";
            $authenticatorController= new $authenticatorName();

            $authenticatorController->initialize();
            $authenticatorController->RefreshTokenAction($data_connector_id);

            $storage=(array)json_decode($data_connector->storage,true);
        }
		}

        if(array_key_exists('rest',$parameters))
        {
           foreach($parameters['rest'] as $item)
           {
           
               $url=$url."/".$item;

           }

        }

        $query_parms=array();

        if(array_key_exists('query',$parameters))
        {
            
            $query_parms=$parameters['query'];

        }

        $header_parms=array();

        if(array_key_exists('headers',$parameters))
        {

            $header_parms=$parameters['headers'];

        }

        $body_parms=array();

        if(array_key_exists('body',$parameters))
        {

            $body_parms=$parameters['body'];

        }
		if(array_key_exists('Authorization',$storage))
		{
        $header_parms['Authorization']=$storage['Authorization'];
		}

        switch ($method)
        {
            case "POST":
                $response = \Unirest\Request::post($url,$header_parms,$body_parms);
                break;
            case "PUT":
                $response = \Unirest\Request::put($url,$header_parms,$body_parms);
                break;
            default:
                $response = \Unirest\Request::get($url,$header_parms,$query_parms);
        }

        $this->view->disable();
		if($echo)
		{
		echo $response->raw_body;
		}

        return $response->raw_body;
        

    }

    public function getResultsOverrideAction($data_connector_id,$method=null,$url=null,$parms_in=null,$clean=false)
    {
        if($url==null)
        {
            $url =$this->url;
        }

        if($method==null)
        {
            $method=$this->method;
        }
        
        
        $data_connector = DataConnector::findFirstByid($data_connector_id);
        
        $storage=(array)json_decode($data_connector->storage,true);

		if(array_key_exists('token_expiry',$storage))
		{
            if(time()>$storage['token_expiry'])
            {
                $authenticatorName = "\PRIME\Authenticators\\".$this->authenticator."Controller";
                $authenticatorController= new $authenticatorName();

                $authenticatorController->initialize();
                $authenticatorController->RefreshTokenAction($data_connector_id);

                $storage=(array)json_decode($data_connector->storage,true);
            }
		}


        if($clean)
        {
        
            $parameters=array();

        }
        else
        {
            $parameters=(array)json_decode($data_connector->parameters,true);
        }

        $parms_in=(array)json_decode($parms_in,true);

        foreach($parms_in as $key=>$value)
        {
        
            $parameters[$key]=$value;
        
        }


        if(array_key_exists('rest',$parameters))
        {
            foreach($parameters['rest'] as $item)
            {
                
                $url=$url."/".$item;

            }

        }

        $query_parms=array();

        if(array_key_exists('query',$parameters))
        {
            
            $query_parms=$parameters['query'];

        }

        $header_parms=array();

        if(array_key_exists('headers',$parameters))
        {

            $header_parms=$parameters['headers'];

        }

        $body_parms=array();

        if(array_key_exists('body',$parameters))
        {

            $body_parms=$parameters['body'];

        }

		if(array_key_exists('Authorization',$storage))
		{
        $header_parms['Authorization']=$storage['Authorization'];
		}

        switch ($method)
        {
            case "POST":
                $response = \Unirest\Request::post($url,$header_parms,$body_parms);
                break;
            case "PUT":
                $response = \Unirest\Request::put($url,$header_parms,$body_parms);
                break;
            default:
                $response = \Unirest\Request::get($url,$header_parms,$query_parms);
        }

        $this->view->disable();
        
        return $response->raw_body;
        

    }

    public function writeMysql($data_connector_id,$data,$queryType="override",$primary_key="auto")
    {
        $data_connector = DataConnector::findFirstByid($data_connector_id);
        $database = OrgDatabase::findFirstByorganisation_id($data_connector->organisation_id);
        
        $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        'host' => $database->db_host,
        'username' => $database->db_username,
        'password' => $database->db_password,
        'dbname' => $database->db_name
        ));

        if($queryType=="override")
        {
            $sql = "DROP TABLE IF EXISTS ".preg_replace("/[^A-Za-z0-9 ]/", "_", $data_connector->type)."_".$data_connector_id;
        }

            $sql = "CREATE TABLE IF NOT EXISTS ".preg_replace("/[^A-Za-z0-9 ]/", "_", $data_connector->type)."_".$data_connector_id."(";
            foreach($data['headings'] as $key=>$column_name)
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

                if($type=="integer")
                {
                    $sql=$sql."`".$column_name."` int DEFAULT NULL, ";
                }
                elseif($type=="double")
                {
                    $sql=$sql."`".$column_name."` real DEFAULT NULL, "; 
                }
                elseif($type=="date")
                {
                    $sql=$sql."`".$column_name."` datetime DEFAULT NULL, "; 
                }
                else
                {
                    $sql=$sql."`".$column_name."` varchar(255) DEFAULT NULL, ";  
                }
            }

            if($primary_key=="auto")
            {
                $sql=$sql."id INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
            }
            elseif($primary_key=="first")
            {
                $sql=$sql."PRIMARY KEY (`".reset($data['headings'])."`)";
            }
            else
            {
                $sql=$sql."PRIMARY KEY (".$primary_key.")";
            }
            
            $sql=$sql.");";                
            

        $connection->query($sql);
 
        $rows=array();

        $sql = "INSERT INTO ".preg_replace("/[^A-Za-z0-9 ]/", "_", $data_connector->type)."_".$data_connector_id." (`".implode ("`,`" , $data['headings'])."`) VALUES ";
            foreach($data as $row)
            {
                if(count($data['headings'])==count($row))
                {
                $rows[]="('".implode ("','" , $row)."')";
                }
            }

            array_shift($rows);

            $sql=$sql.implode (", " , $rows)." ON DUPLICATE KEY UPDATE ";

            $duplicate_values=array();

           foreach($data['headings'] as $column_name)
            {
                $duplicate_values[]="`".$column_name."` =VALUES(`".$column_name."`)";        
            }

           $sql=$sql.implode (" ," , $duplicate_values).";";

           $connection->query($sql);

    }


}
