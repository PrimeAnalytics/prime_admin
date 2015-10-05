<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;

class DashboardBase extends Controller
{    
    public $dashboard_type = "";
    public $organisation_id ="";
    private $view_dir;
    public $form_struct='';
    
    function onConstruct()
    {
        $this->dashboard_type = __CLASS__;
        
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
        }
        
        
        
    }

    public function getDashboardsAction()
    {
        $this->view->disable();
        
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");

            
            $organisation = Organisation::findFirstByid($auth['organisation_id']);   
            $dashboards = $organisation->Dashboard;
            
            $json = array();
            foreach($dashboards as $dashboard)
            {
                $json[] = array(
                        'id' => $dashboard->id,
                                   'text' => $dashboard->title
                                 );
            }
            
            echo json_encode($json);
            
        }
        
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
        
        
    }



















    public function renderAction($id,$type,$links=null)
    {
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->view->setViewsDir('../app/themes/'.$auth['theme'].'/');
        }
        
        $dashboard = Dashboard::findFirstByid($id);    
        $organisation= Organisation::findFirstByid($dashboard->organisation_id);
        
        $this->view->setTemplateAfter($dashboard->style);
        $this->view->pick(strtolower("dashboard/".$dashboard->style));
        
        $links = $organisation->Links;

        $this->view->setVar("links", $links); 

        $widgets = $dashboard->Widget;

        
        foreach ($widgets as $widget) {
            $parameters =array();
            $parameters= (array)json_decode($widget->parameters,true);
            
            echo '<script> var update_'.$widget->id.' = function(link){

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
            var encoded = encodeURIComponent(btoa(JSON.stringify(links)));
            $("div[data-widget_id='.$widget->id.']").load("/widgets/'.$widget->type.'/update_default/'.$widget->id.'/"+encoded+"/"+table_append);
            
          }
          
          }
          
          </script>
          ';
        }
        
        $canvas = Canvas::find(array(
    'dashboard_id ='.$dashboard->id,
    "order" => "column"
));
        
        $this->view->setVar("dashboard", $dashboard); 
        $this->view->setVar("organisation", $organisation);
        
        $this->view->setVar("links", json_decode($dashboard->links,true)); 
        
        if($type=="builder")
        {
            $this->view->setVar('class', 'dropzone-row');           
            foreach ($canvas as $canvasItem) {
                echo '<script> 
              $("div").find("[data-rowNumber='.$canvasItem->row.']").before(\'<div class="placeholder-container"><div class="placeholder"><div class="placeholder-content ui-droppable"><div class="placeholder-content-area">\');
                $("div").find("[data-rowNumber='.$canvasItem->row.']").append( $("<div></div>").load("/Canvas/render/'.$canvasItem->id.'/builder", function(){
                
                parent.update_dropzone();
                
                }));
                </script>';
            };
        }
        
        else
        {
            $this->view->setVar('class', 'row');
            
            
            foreach ($canvas as $canvasItem) {
                echo '
                <script> 
              
                $("div").find("[data-rowNumber='.$canvasItem->row.']").append( $("<div></div>").load("/Canvas/render/'.$canvasItem->id.'/dashboard"));
                </script>';
            };
            
        }
        
        if($links==null)
        {
            
            echo " 
                <script>
                       var links = ".$dashboard->links.";
                       var table_append = '".$table_append."';
                       </script>";
        }
        else
        {
            echo '<script>
                var table_append = "'.$table_append.'";
                var links = '.$dashboard->links.';
                var d_links = '.$links.';
                $.each(links, function(index, key ) {
                $.each(d_links, function(index_d, key_d ) {

          if(links[index].name==d_links[index_d].name)
          links[index].default_value= d_links[index_d].value;
          });
          });
</script>
';
            
        }
        
        echo '<script>
            
            function update_dashboard(link, value)
            {  
            
      
            $.each(links, function(index, key ) {
            if( links[index].name==link)

            links[index].default_value = value;

            }); 
            ';
        
        
        foreach ($widgets as $widget) {
            
            echo "update_".$widget->id."(link);";
            
        }
        
        echo '
            }  

            </script>';

    }
 
    
}
