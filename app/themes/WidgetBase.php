<?php
namespace PRIME\Widgets;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Widget;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Organisation;
use PRIME\Models\Canvas;

class WidgetBase extends Controller
{    
    public $icon = "fa-cogs";
    public $widget_name = "";
    public $organisation_id ="";
    private $view_dir;
    public $form_struct='';
    
    function onConstruct()
    {
        $widget_name = $this->router->getControllerName();
        $widget_name = str_replace('_', ' ', $widget_name);
        $this->widget_name = ucwords($widget_name);
        
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
        }
        
        $organisation = Organisation::findFirstById($this->organisation_id);
        
        $this->view->setViewsDir('../app/widgets/'.$organisation->theme.'/');
        
        $this->view->setLayoutsDir('/');
        
        $this->view_dir = str_replace('PRIME\Widgets\\'.ucwords($organisation->theme).'\\', '', $this->router->getNamespaceName());
        
    }


    function getCSVAction($widget_id,$links=null,$table_append="") 
    {
    
        $widget = Widget::findFirstByid($widget_id);
        
        $data=(array)json_decode($widget->parameters,true);
        
        $widget_links= array();
        
        if($links!=null && $data['link']['widget_update_links']!="")
        {
            
            $links=json_decode(base64_decode($links), true);
            
            foreach($links as $link)
            {
                if(in_array ( $link["name"] ,  $data['link']['widget_update_links'], true))
                {
                    if($link['default_value']=="")
                    {
                        $this->view->disable();
                        return null;
                    }
                    
                    $widget_links[]=$link;
                    
                }
            }
        }
        
        
        $this->view->disable();
        
        $this->view->setVar("widget", $widget);
        
        $data_out = $this->getData($data,$widget_links,$table_append,$this->getUserDB());
        
        // var_dump($data_out);
        
        if(array_key_exists ( 'db' , $data_out))
        {
            
            echo json_encode($data_out['db']);
            
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
                $db= new \PDO("mysql:dbname=$mySqlDatabase;host=$host;",$mySqlUser,$mySqlPassword,array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));    
            }
            catch(PDOException $ex){
                
                die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
            }
        
        return $db;
    }
     
    
    public static function getData($data,$widget_links,$table_append,$db)
    {     
        
        $row_limit=200;
        $data_out=array();

        if(array_key_exists ( 'db' , $data))
        {           
            
            $db_tables=$data['db'];
            
            $data_out=$data;
            
            foreach($db_tables as $key=>$db_table)
            {
                $db_table_name =$db_table['table'].$table_append;
                unset($db_table['table']);
                $db_query_type=$db_table['type'];
                unset($db_table['type']);
                
                if($db_query_type=="procedure")
                {
                
                $parameters = array();
                            if(is_array($link))
                            {
                                $dbTables = $db->prepare("SELECT PARAMETER_NAME AS NAME FROM information_schema.parameters WHERE SPECIFIC_NAME = '".$db_table_name."' AND SPECIFIC_SCHEMA= database()");
                                $dbTables->execute();
                                
                           while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
                            {		
                                foreach($row as $key=>$value) {
                                    foreach($widget_links as $link) 
                                    { 
                                    if($link['name']==$value)
                                    {
                                    $parameters[] = $link['default_value'];
                                    }
                                    }
                                }
                            }  
                                
                            }
                            
                            if(0 != count($parameters))
                            {

                         $db_table_name=$db_table_name."('".implode("','",$parameters)."')";  

                         }

                         else 
                         {
                         $db_table_name = $db_table_name."()";
                         }
                }
                              
                $select_string = "";
                
                if(array_key_exists( 'widget_link_column' , $db_table ))
                {
                    if($db_table['widget_link_column']==null)
                    {
                        unset($db_table['widget_link_column']);
                    }
                }
                
                    foreach($db_table as $column=>$value)
                    {
                        if(is_array($value)){
                            foreach($value as $column_sub=>$value_sub)
                            {
                                if(is_array($value_sub)){          
                                }
                                else
                                {
                                    if($value_sub!=null){
                                        $select_string = $select_string." , `".$value_sub."` AS `".$value_sub."`";
                                    }
                                    else
                                    {
                                        $select_string = $select_string." , '0' AS `0`";
                                    }
                                }
                                
                            }     
                            
                        }
                        else
                        {
                            
                            if($value!=null){
                                $select_string = $select_string." , `".$value."` AS `".$column."`";
                            }
                            else
                            {
                                $select_string = $select_string." , '0' AS  `".$column."`";
                            }
                            
                        }
                        
                        
                    }     
                    $select_string = substr($select_string, 2);

                    if($select_string !="") 
                    {
                        $filter_string="";
                        
                        foreach($widget_links as $link) 
                        {
                            if(is_array($link))
                            {
                                $dbTables = $db->prepare("SHOW COLUMNS FROM `$db_table_name`");
                                $dbTables->execute();
                                $filter=false;
                                
                                while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
                                {		
                                    if($link['column'] == $row['Field'])
                                    {
                                        $filter=true;
                                    }
                                }                        
                                
                                if ($filter==true )
                                {
                                    
                                    $filter_string = $filter_string." AND `".$link['column']."`".(array_key_exists("type", $link) ? $link['type'] : "=")."'".$link['default_value']."'";
                                    
                                }
                            }
                            
                        }
                        
                        if($filter_string !="") 
                        {
                            $filter_string = "WHERE ".substr($filter_string, 4);
                        }
                        
                        $statement=$db->prepare("SELECT $select_string FROM `$db_table_name` $filter_string Limit $row_limit");
                        
                        if($statement->execute())
                        {
                        
                            $data_out['db'][$key]=array();

                            
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
                                $data_out['db'][$key][]= $row;
                            }
                        }
                    }
            }
        }
        
        if(array_key_exists('parm', $data))
        {
            $data_out['parm']=$data['parm'];
        }

        return $data_out;
    }
    
       
    public function update_defaultAction($widget_id,$links=null,$table_append="")
    {     
        $widget = Widget::findFirstByid($widget_id);
        
        $data=(array)json_decode($widget->parameters,true);
        
        $widget_links= array();
        
        if($links!=null && $data['link']['widget_update_links']!="")
        {
            
            $links=json_decode(base64_decode($links), true);
            
            foreach($links as $link)
            {
                if(in_array ( $link["name"] ,  $data['link']['widget_update_links'], true))
                {
                    if($link['default_value']=="")
                    {
                        $this->view->disable();
                        return null;
                    }
                    
                    $widget_links[]=$link;
                    
                }
            }
        }
        
        $this->view->pick(strtolower("/".$widget->type."/update"));
        
        $this->view->setVar("widget", $widget);
        
        $data_out = $this->getData($data,$widget_links,$table_append,$this->getUserDB());
        
       // var_dump($data_out);
                
        if (is_array($data_out))
        {
            $this->view->setVar("data",$data_out);
        }
        else
        {
            $this->view->disable();
            echo "Something went wrong please try reloading the page";
            
        }
        
    }
            
    
    /**
     * Creates a new widget
     */
    public function createAction()
    {
        $widget = new Widget();

        $widget->type = $this->request->getPost("type");
        $widget->column = $this->request->getPost("column");
        $widget->row = $this->request->getPost("row");
        $widget->width = $this->request->getPost("width");
        $widget->csv = $this->request->getPost("csv");
        $widget->canvas_id = $this->request->getPost("canvas_id");
        
        $widget->dashboard_id = Canvas::findFirstByid($widget->canvas_id)->dashboard_id;
        
        $widget->parameters = json_encode($this->request->getPost("parameters") );
        

        if (!$widget->save()) {
            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "namespace" => "PRIME\Controllers",
        "controller" => "dashboard",
        "action"     => "edit",
        "params"     => array('id' => $widget->dashboard_id)
    ));
        }

        $this->flash->success("widget was created successfully");

        return $this->dispatcher->forward(array(
        "namespace" => "PRIME\Controllers",
        "controller" => "dashboard",
        "action"     => "edit",
        "params"     => array('id' => $widget->dashboard_id)
        ));
    }
    
    /**
     * Displays the creation form
     */    
    public function newAction($canvas_id,$row,$column)
    {
        $this->view->disable();
        $echo_array= array();
        
        $dashboard_id= Canvas::findFirstById($canvas_id)->dashboard_id;
        $type = strtolower($this->view_dir."/".$this->router->getControllerName());        
        $header_text = "Create New ". $this->widget_name;
        $icon = $this->icon; 
        $form_type = "widgets/". strtolower($this->view_dir."/".$this->router->getControllerName())."/create"; 
        
        
        
        //references begin

        $echo_array['ref'][]= '
        <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
        ';
        $echo_array['ref'][]='
        <link href="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" media="screen"/>
        <script src="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
        <script src="/assets/plugins/select2/js/select2.js" type="text/javascript"></script>
        ';
        $echo_array['ref'][]= '
        <link href="/assets/plugins/icon-picker/css/fontawesome-iconpicker.min.css" rel="stylesheet">
        <script src="/assets/plugins/icon-picker/js/fontawesome-iconpicker.js"></script>
        ';

        //references end
        
        
        $struct=$this->form_struct;
        $struct= json_decode($struct,TRUE);
        
        
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
              
        $echo_array['html']['body'][] = $this->tag->hiddenField(array("type", "value" => $type));
        $echo_array['html']['body'][] = $this->tag->hiddenField(array("canvas_id", "value" => $canvas_id));
        $echo_array['html']['body'][] = $this->tag->hiddenField(array("column", "value" => $column));
        $echo_array['html']['body'][] = $this->tag->hiddenField(array("row", "value" => $row));
        $echo_array['html']['body'][] = $this->tag->hiddenField(array("dashboard_id", "value" => $dashboard_id));
        
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
        
        
        $echo_array['html']['body']['parm'][]='<h4>Basic Settings</h4>
                                        <div class="row form-row" >';
        
        $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                            <label class="form-label">Width</label>
                                            <select name="width" style="width:100%">
                                                <option value="col-md-12">100%</option>
                                                <option value="col-md-9">75%</option>
                                                <option value="col-md-8">66%</option>
                                                <option value="col-md-6">50%</option>
                                                <option value="col-md-4">33%</option>
                                                <option value="col-md-3">25%</option>
                                            </select>
                                          </div>';  
        $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                            <label class="form-label">CSV Export</label>
                                            <select name="csv" style="width:100%">
                                                <option value="enable">Enable</option>
                                                <option value="disable">Disable</option>
                                            </select>
                                          </div>';  
                                          
           if( array_key_exists ( 'parm' , $struct))
        {
             $parms = $struct['parm'];
                   foreach($parms as $parm)
                   {
                      if($parm['type']== 'input')
                      {
                          $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <input type="text" name="parameters[parm]['.$parm['name'].']" style="width:100%" ></input>
                                </div>';  
                      }
                      elseif($parm['type']== 'select')
                      {
                        $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <select name="parameters[parm]['.$parm['name'].']" style="width:100%" >';
                                foreach($parm['values'] as $option)
                          {
                        $echo_array['html']['body']['parm'][]= '<option value="'.$option['id'].'" >'.$option['value'].'</$option>';
                          };      
                        $echo_array['html']['body']['parm'][]= '</select>
                                </div>';
                      } 
                        elseif($parm['type']== 'color')
                      {
                        $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <select name="parameters[parm]['.$parm['name'].']" style="width:100%" >
                                <option value="[\'#058DC7\', \'#50B432\', \'#ED561B\', \'#DDDF00\', \'#24CBE5\', \'#64E572\',\'#FF9655\', \'#FFF263\', \'#6AF9C4\']">Default</option>
                                <option value="[\'#99ff99\', \'#99ffff\', \'#e7a3fd\', \'#e8e8e8\', \'#ffeb99\', \'#ff3300\']">Lumen</option>
                                <option value="[\'#f1511b\', \'#80cc28\', \'#00adef\', \'#fbbc09\', \'#706d6e\']">Microsoft</option>
                                </select>
                                </div>';
                      } 
                      
                      elseif($parm['type']== 'icon')
                      {
                        $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <div class="input-group">
                                <input class="form-control icp icp-auto" name="parameters[parm]['.$parm['name'].']" style="width:100%" ></input>
                                <span class="input-group-addon"></span>
                        </div>
                                </div>';
                      } 
                      
                      elseif($parm['type']== 'table')
                      {
                          $echo_array['html']['body']['parm'][]= '
                                                <div class="col-md-12">
                                                        <label class="form-label">Database Table</label>
                                                        <input class="dbTable" style="width:100%" name="parameters[parm]['.$parm['name'].']">
                                                        </input>
                                                </div>';
                      }  
                      
                   } 

        }
        
        $echo_array['html']['body']['parm'][] = '</div>';   
        
                    //body settings end
        
                    //body database start
        
       if( array_key_exists ( 'db' , $struct))
       {
           $db_tables = $struct['db'];
           foreach($db_tables as $key=>$db_table)
            {
            $echo_array['html']['body']['db'][$key][] = '<h4>'.ucwords(str_replace ("_" , " " , $key)).'</h4>
                                                    <div class="row form-row" >';
                                                    
            $echo_array['html']['body']['db'][$key][]  = '<div class="col-md-6">
                                                        <label class="form-label">Data Source Type</label>                    
                                                        <select id="'.$key.'dbType" style="width:100%" name="parameters[db]['.$key.'][type]">
                                                          <option value="table">Table</option>
                                                          <option value="procedure">Procedure</option>
                                                        </select>
                                                </div>';
            
            $echo_array['html']['body']['db'][$key][]  = '<div class="col-md-6">
                                                        <label class="form-label">Data Source</label>
                                                        <input id="'.$key.'dbTable" class="dbTable" style="width:100%" name="parameters[db]['.$key.'][table]">
                                                        </input>
                                                </div>
                                                </div>

                                                <div id="'.$key.'data_source_countainer">
                                                
                                                </div>
                                                <div class="row form-row" >
                                                
                                                ';
            
                     foreach($db_table as $entry)
                            {
                                if($entry['type'] == 'single')
                                {
                                    $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">'.$entry['label'].'</label>
                                                <input class="'.$key.'column_s" style="width:100%" name="parameters[db]['.$key.']['.$entry['name'].']">
                                                </input>
                                          </div>';
                                }
                                elseif ($entry['type'] == 'multiple')
                                {
                                    $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">'.$entry['label'].'</label>
                                                <input class="'.$key.'column_sm" style="width:100%"  " ></input>
                                                <select id = "'.$key.$entry['name'].'" style="display:none" multiple="multiple" name="parameters[db]['.$key.']['.$entry['name'].'][]" >
                                                </select>
                                          </div>';
                
                                }
            
                                elseif ($entry['type']=='link')
                                {
                                    $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">Link</label>
                                                <input id="'.$key.'-widget-dashboard-link" class="dashboardLinks_s" name="parameters[link]['.$key.']" style="width:100%">
                                                </input>
                                          </div>

                                                     <div class="col-md-6 '.$key.'column" style="display:none">
                                                        <label class="form-label">Linking Column</label>
                                                        <div style="width:100%">
                                                          <input id="'.$key.'-widget-link-column" class="'.$key.'column_s" name="parameters[db]['.$key.'][widget_link_column]" style="width:100%" >
                                                          </input>
                                                        </div>
                                                      </div>
                                          ';
                                    }

									elseif ($entry['type']=='click_link')
                                {
                                    $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">Link</label>
                                                <input id="'.$key.'-widget-dashboard-link" class="dashboardLinks_s" name="parameters[link]['.$key.']" style="width:100%">
                                                </input>
                                          </div>

                                                     <div class="col-md-6 '.$key.'column" style="display:none">
                                                        <label class="form-label">Linking Value</label>
                                                        <div style="width:100%">
                                                          <input class="form-control" name="parameters[parm]['.$key.'][widget_link]" style="width:100%" >
                                                          </input>
                                                        </div>
                                                      </div>
                                          ';
                                    }

                                elseif($entry['type']== 'dashboard_link')
                                {
                                    $echo_array['html']['body']['db'][$key][] = '
                                                <div class="col-md-12 '.$key.'column" style="display:none">
                                                        <label class="form-label">Target Dashboard</label>
                                                        <input class="dashboardList" style="width:100%" name="parameters[dashboard_link]['.$key.']">
                                                        </input>
                                                </div>

                                        <div class="col-md-6 '.$key.'dashboard_column" style="display:none">
                                                <label class="form-label">Target Dashboard Link</label>
                                                <input id="'.$key.'-widget-dashboard-link" class="dashboardLinks_rs" name="parameters[link]['.$key.']" style="width:100%">
                                                </input>
                                          </div>
                                                     <div class="col-md-6 '.$key.'dashboard_column" style="display:none">
                                                        <label class="form-label">Linking Column</label>
                                                        <div style="width:100%">
                                                          <input id="'.$key.'-widget-link-column" class="'.$key.'column_s" name="parameters[db]['.$key.'][widget_link_column]" style="width:100%" >
                                                          </input>
                                                        </div>
                                                      </div>
                                          ';

                                }

                                }
                                
                                
                  $echo_array['html']['body']['db'][$key][]  = '              
                                          </div>
                                          ';            
                }
                

          $echo_array['html']['body']['db']['update'] = '
           <h4>Update Links</h4>
           <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">Links</label>
                    <div style="width:100%">
                      <input multiple="multiple" class="dashboardLinks_sm" style="width:100%"></input>
                      <select id="widget-dashboard-link" multiple="multiple"  name="parameters[link][widget_update_links][]" style="width:100%; display: none;"></select>
                    </div>
                </div>
            </div>
            ';
            
           }
        
        
        
        // html part end
        
        
        
        
        
        // script part start
        
        $echo_array['script'][]='<script>';
        
             if( array_key_exists ( 'parm' , $struct))
        {
             $parms = $struct['parm'];
                   foreach($parms as $parm)
                   {
                      if($parm['type']== 'input')
                      {
                      

                      }
                      elseif($parm['type']== 'select')
                      {
                      

                      } 
                      elseif($parm['type']== 'icon')
                      {
                      
                       $echo_array['script']['parm']['icon']='$(".icp-auto").iconpicker();
                       ';

                      } 
                      
                      elseif($parm['type']== 'table')
                      {
                          
                          $echo_array['script']['parm']['table']=' 
                                                        $.getJSON("/widget/getDBTables", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });
                       ';

                      } 
                      
                   }

        }

                    //body settings end
        
                    //body database start
        
       if( array_key_exists ( 'db' , $struct))
       {
       
        $echo_array['script']['db'][]=' 
            $.getJSON("/widget/getDBTables", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });
                                                    ';    
       
           $db_tables = $struct['db'];
           foreach($db_tables as $key=>$db_table)
            {
             $echo_array['script']['db'][$key][] ='$("#'.$key.'dbType").on("change", function (e){
             
                                                        var type_select=$( this ).val();
                                                        
                                                        if(type_select=="procedure")
                                                        {
                                                        
                                                        $.getJSON("/widget/getDBProcedures", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Procedure",
                                                        data:data
                                                        })
                                                        });      
                                                        
                                                        }
                                                        else if (type_select=="table")
                                                        {
                                                        $.getJSON("/widget/getDBTables", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });                                                 
                                                        }
                                                        });
                                                        ';

            
            $echo_array['script']['db'][$key][] ='$("#'.$key.'dbTable").on("change", function (e){
                                                        $(".'.$key.'column").show();
                                                        var db_table = e.val;
                                                        
                                                        var type = $("#'.$key.'dbType").val();
                                                        
                                                        var action;
                                                        
                                                        if (type=="procedure")
                                                        {
                                                        
                                                        action="getProcedureColumns";
                                                        
                                                        $.getJSON("/widget/getProcedureParameters/"+db_table, function(data){
                                                        if(data!="")
                                                        {
                                                        var parms_html=\'<h5>Procedure Parameter Links</h5><div class="row form-row" >\';
                                                        
                                                        $.each( data, function( key, value ) {
                                                        var str= \'<div class="col-md-6"><label class="form-label">\' + value.id + \'</label><input class="dashboardLinks_s" name="parameters[link]['.$key.'][\' + value.id + \']" style="width:100%"></input></div> \';
                                                        parms_html = parms_html + str;
                                                        });
                                                        
                                                        parms_html = parms_html + \'</div>\';
                                                        
                                                        $("#'.$key.'data_source_countainer").html(parms_html);
                                                        update_dashboard_links();
                                                        }
                                                        });
                                                        }
                                                        else if (type=="table")
                                                        {

                                                        action="getDBColumns";
                                                        
                                                        $("#'.$key.'data_source_countainer").html("");
                                                        
                                                        }
                                                        
                                                        $.getJSON("/widget/"+action+"/"+db_table, function(data){';
                                          
                     foreach($db_table as $entry_key=>$entry)
                            {
                                if($entry['type'] == 'single')
                                {
                                    
                                    $echo_array['script']['db'][$key]['single']='$(".'.$key.'column_s").select2({
                                                                                        placeholder: "Select a Column",
                                                                                        data:data
                                                                                        });
                                                                                        ';

                                }
                                elseif ($entry['type'] == 'multiple')
                                {
                                    $echo_array['script']['db'][$key]['multiple']['head']='
                                 $(".'.$key.'column_sm").select2({
                                                                  placeholder: "Select Columns",
                                                                  data:data,
                                                                  multiple: true
                                                                  }).on("change", function (e){
                                                                  ';
                                    
                                    $echo_array['script']['db'][$key]['multiple'][$entry_key]='
                                data = e.val;
                                        
                                $("#'.$key.$entry['name'].'").empty();
                                                             
                                $.each(data , function(key, value) 
                                       {
                                         $("#'.$key.$entry['name'].'").append("<option value=" + data[key] + ">" + data[key] + "</option>");
                                       })
                                                            
                                $("#'.$key.$entry['name'].' option").prop("selected", true)
                                                                                                                       
                                 });
                                 ';

                                }
                                elseif ($entry['type']=='link')
                                {
                                    $echo_array['script']['db'][$key]['single']='$(".'.$key.'column_s").select2({
                                                                                        placeholder: "Select a Column",
                                                                                        data:data
                                                                                        });
                                                                                        ';
                                }

                                elseif($entry['type']== 'dashboard_link')
                                {

                                    $echo_array['script']['db'][$key]['dashboard_link']=' 
                                                        $.getJSON("/dashboard/getDashboards", function(data){
                                                        $(".dashboardList").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });

                                    $(".dashboardList").on("change", function (e){
                                        $(".'.$key.'dashboard_column").show();
                                        var type_select=$( this ).val();
                                       $.getJSON("/dashboard/getLinks/"+type_select, function(data_in){
                                        var data=[];
                                        $.each(data_in, function(i, item) {
                                        item=JSON.stringify(item);
                                                    var jsonObj =
                                                        {
                                                        "text":data_in[i].name,
                                                        "id": data_in[i].name
                                                        };
                                                        data.push(jsonObj);
                                            });
                
                                            $(".dashboardLinks_rs").select2({
                                                          placeholder: "Select Dashboard Linking Variable",
                                                          data:data
                                              });
                                                
                                            });
                                            
                                            });

                                            ';

                                    $echo_array['script']['db'][$key]['single']='$(".'.$key.'column_s").select2({
                                                                                        placeholder: "Select a Column",
                                                                                        data:data
                                                                                        });
                                                                                        ';

                                } 
                            }
                            
            $echo_array['script']['db'][$key][] ='
                                   });
                                   });
                                   '; 
            }
            

           $echo_array['script']['db'][]= '
           function update_dashboard_links()
           {
           $.getJSON("/dashboard/getLinks/'.$dashboard_id.'", function(data_in){
                                        var data=[];
                                        $.each(data_in, function(i, item) {
                                        item=JSON.stringify(item);
                                                    var jsonObj =
                                                        {
                                                        "text":data_in[i].name,
                                                        "id": data_in[i].name
                                                        };
                                                        data.push(jsonObj);
                                            });
                
                                            $(".dashboardLinks_s").select2({
                                                          placeholder: "Select Dashboard Linking Variable",
                                                          data:data
                                              });
                                                
                                              $(".dashboardLinks_sm").select2({
                                                placeholder: "Select Dashboard Linking Variables",
                                                data:data,
                                                multiple: true
                                                }).on("change", function (e){
                                                 data = e.val;
                                         
                                                 $("#widget-dashboard-link").empty();
                                         
                                                 $.each(data, function(i, item) {
                  
                                                      $("#widget-dashboard-link").append("<option value="+ item +" >" + item + "</option>");
                                                    })

                                                $("#widget-dashboard-link option").prop("selected", true);
                                                 });
                                        
                                            });
                                            
                                            }
                                            
                                            update_dashboard_links();
                                            
                                            ';
                        
        }
        
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
      
    
    public function builderAction($id)
    {  
        $this->view->disable();
        
        $widget = Widget::findfirst('id ='.$id);
        
        $parameters= json_decode($widget->parameters,true);
         
        echo '<div class="widget_drag ImageWrapper '.$widget->width.'" data-type="u_'.$widget->type.'" data-widget_id="l_'.$widget->id.'" >
                <div data-type="u_'.$widget->type.'" data-widget_id="'.$widget->id.'" ></div>

                <div class="ImageOverlayH" ></div><div class="Buttons StyleH" >
                  <span class="WhiteRounded draghandle">
                    <a>
                      <i class="fa fa-arrows"></i>
                    </a>
                  </span>
                  <span class="WhiteRounded">
                    <a href="javascript:void(0);" onclick="parent.widget_edit( '."'".$widget->type."'".' , '."'".$widget->id."'".' )" ><i class="fa fa-cogs"></i>
                    </a>
                  </span>
                  <span class="RedRounded">
                    <a href="javascript:void(0);" onclick="parent.widget_delete( '."'".$widget->id."'".' )"><i class="fa fa-trash-o"></i>
                    </a>
                  </span>
                </div>
                </div>';
        
 echo '<script>


          var update_'.$widget->id.' = function(link){
                      
          
          var w_links ='.(array_key_exists ( 'widget_update_links' , (array_key_exists ( 'link' , $parameters )? $parameters['link'] : []) )? json_encode($parameters['link']['widget_update_links']) : "[]").';
          
          
          var widget_id ='.$widget->id.';
          var widget_type ="'.$widget->type.'";
           
            var update=false;
            
            if( link == 0 )
            {
            update=true;
            }
            else
            {
            
            
            $.each(w_links, function(index, key ) {
                      if( w_links[index]==link)
                      {
                      update=true;
                      
          
                      return false;
                      }
                      });
            }

            if(update == true)
            {

              var encoded= encodeURIComponent(JSON.stringify(links)).replace(/[!\'()*]/g, function(c) {
                return \'%\' + c.charCodeAt(0).toString(16);
              });
           
            $("div[data-widget_id='.$widget->id.']").load("/widgets/'.$widget->type.'/update_default/'.$widget->id.'/"+encoded+"/"+table_append);
            }
            
            
          };';
        
        echo 'update_'.$widget->id.'(0);';

        echo '</script>';
        
    }
    
    public function dashboardAction($id)
    {  
        $this->view->disable();
        
        $widget = Widget::findfirst('id ='.$id);
        
        $parameters= json_decode($widget->parameters,true);
        
        echo '<div class="'.$widget->width.'">';
        if($widget->csv=='enable')
        {
         echo '<a style="cursor: pointer; cursor: hand;" id="csv_'.$widget->id.'"><i class="fa fa-file-excel-o"></i> CSV</a>
                <a id="dcsv_'.$widget->id.'"><a>';
                
        }
                
                echo '<div data-type="u_'.$widget->type.'" data-widget_id="'.$widget->id.'" ></div>
                </div>';
    
                if($widget->csv=='enable')
                {
                    
                    echo '<script>
              
                        function JSON2CSV(objArray) {
    var array = typeof objArray != \'object\' ? JSON.parse(objArray) : objArray;

    var str = \'\';
    var line = \'\';


        var head = array[0];
        
            for (var index in array[0]) {
                var value = index + "";
                line += \'"\' + value.replace(/"/g, \'""\') + \'",\';
            }


        line = line.slice(0, -1);
        str += line + \'\r\n\';

    for (var i = 0; i < array.length; i++) {
        var line = \'\';


            for (var index in array[i]) {
                var value = array[i][index] + "";
                line += \'"\' + value.replace(/"/g, \'""\') + \'",\';
            }

        line = line.slice(0, -1);
        str += line + \'\r\n\';
    }
    return str;
    
}

                    $( "#csv_'.$widget->id.'" ).on("click", function() {
                            var encoded = encodeURIComponent(btoa(JSON.stringify(links)));
            
                        $.getJSON("/widgets/'.$widget->type.'/getCSV/'.$widget->id.'/"+encoded+"/"+table_append ,function(data){

                        
                            $.each(data, function(k , v) {
                             var csvString = JSON2CSV(v);
                             
                                    var a   = document.getElementById("dcsv_'.$widget->id.'");
                                    a.href        = \'data:attachment/csv,\' + escape(csvString);
                                    a.target      = \'_blank\';
                                    a.download    = \'DataExport.csv\';

                                    a.click(); 
                             
                             
                             
                            });
                            });
                            
                            });
                            
                            </script>
                            
                            ';
                    
                }
            
            echo '<script>
          
         $( document ).ready(function() {';

                echo "update_".$widget->id."(0);";
                        
            echo '});
          

          ';
        
        echo '</script>';
        
    }
    

    public function editAction($id)
    {
        $this->view->pick(strtolower($this->view_dir."/".$this->router->getControllerName()).'/edit');

        $this->view->setTemplateAfter('modal');
        
        $this->tag->setDefault("type", $this->router->getControllerName());
        
        $this->view->setVar("header_text", "Edit ". $this->widget_name);
        $this->view->setVar("icon", $this->icon);
        $this->view->setVar("form_type", "widget/save"); 
        
            $widget = Widget::findFirstByid($id);
            
            $this->view->setVar("widget_id", $id); 
            $this->view->setVar("type", $this->router->getControllerName()); 
            $this->tag->setDefault("id", $widget->id);
            $this->tag->setDefault("row", $widget->row);
            $this->tag->setDefault("width", $widget->width);
            $this->view->setVar("dashboard_id", $widget->dashboard_id);
            
            echo $this->tag->hiddenField("id");
  
            $parameters = json_decode($widget->parameters,true);
             
    }
    
}
