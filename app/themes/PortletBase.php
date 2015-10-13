<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Widget;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Organisation;
use PRIME\Models\Canvas;

class PortletBase extends Controller
{    
    public $portlet_name = "";
    public $organisation_id ="";
    private $view_dir;
    public $form_struct='';
    
    function onConstruct()
    {
        $portlet_name = $this->router->getControllerName();
        $portlet_name = str_replace('_', ' ', $portlet_name);
        $this->portlet_name = ucwords($portlet_name);
        
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
        }
        
        $organisation = Organisation::findFirstById($this->organisation_id);
        
        $this->view->setViewsDir('../app/widgets/'.$organisation->theme.'/');
        
        $this->view->setLayoutsDir('/');
        
        $this->view_dir = str_replace('PRIME\\'.$organisation->theme.'\Canvas', '', $this->router->getNamespaceName());
        
    }
     
       
    public function update_defaultAction($canvas_id,$links=null,$table_append="")
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
     * Creates a new canvas
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
    public function newAction($row,$column)
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;

        $this->view->setViewsDir('../app/views/');
        $this->view->pick('portlets/new');

        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);

        $this->view->setVar("form_body", $form_body);
        $this->view->setVar("type", $this->portlet_name);

        $form_type='portlet/create';
        $this->view->setVar("form_type", $form_type);
        
 
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
