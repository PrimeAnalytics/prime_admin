<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Dashboard;
use PRIME\Models\Links;
use PRIME\Models\Widget;
use PRIME\Models\Portlet;
use PRIME\Models\Organisation;

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

    public function editAction($id)
    {
        $this->view->setViewsDir('../app/views/');
        $this->view->pick('dashboard/edit');

        $this->view->setTemplateAfter('main');

            $dashboard = Dashboard::findFirstByid($id);
            
            $organisation = Organisation::findFirstByid($dashboard->organisation_id);
            $this->view->setVar('theme',$organisation->theme);

            $WidgetList=\PRIME\Controllers\WidgetController::getWidgetList();

            $this->view->setVar("widgetList", $WidgetList); 

            $PortletList=\PRIME\Controllers\PortletController::getPortletList();

            $this->view->setVar("portletList", $PortletList); 

            $DashboardList=\PRIME\Controllers\DashboardController::getDashboardList();

            $this->view->setVar("dashboardList", $DashboardList); 


            $portlets = $dashboard->Portlet;
            $this->view->setVar("portlets", $portlets); 

            $this->view->setVar("dashboard_id", $dashboard->id);  
            $this->view->setVar("dashboard_type", $dashboard->type);
            $this->view->setVar("links", $organisation->links);
            $this->view->setVar("organisation_id", $dashboard->organisation_id);
            
            $this->view->id = $dashboard->id;
            
            $this->tag->setDefault("type", $dashboard->type);
            $this->tag->setDefault("id", $dashboard->id);
            $this->tag->setDefault("title", $dashboard->title);
            $this->tag->setDefault("icon", $dashboard->icon);
            $this->tag->setDefault("weight", $dashboard->weight);
            $this->tag->setDefault("organisation_id", $dashboard->organisation_id);
            
        
        
    }


    public function renderAction($id,$type,$links=null)
    {
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->view->setViewsDir('../app/themes/'.$auth['theme'].'/dashboards/');
        }
        
        $dashboard = Dashboard::findFirstByid($id);    
        $organisation= Organisation::findFirstByid($dashboard->organisation_id);
        
        $this->view->pick(strtolower($dashboard->type."/view"));
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
       
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
        
        $portlets = Portlet::find(array(
    'dashboard_id ='.$dashboard->id,
    "order" => "column"
));
        
        $this->view->setVar("dashboard", $dashboard); 
        $this->view->setVar("organisation", $organisation);
        
        $this->view->setVar("links", $organisation->Links); 
        
        if($type=="builder")
        {
            $this->view->setVar('class', 'dropzone-row');           
            foreach ($portlets as $portlet) {
                echo '<script> 
              $("div").find("[data-rowNumber='.$portlet->row.']").before(\'<div class="placeholder-container"><div class="placeholder"><div class="placeholder-content ui-droppable"><div class="placeholder-content-area">\');
                $("div").find("[data-rowNumber='.$portlet->row.']").append( $("<div></div>").load("/portlets/'.$portlet->type.'/render/'.$portlet->id.'/builder", function(){
                
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
