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

        echo '<style>
 .placeholder-container {
  background-color: #ffffff;
  min-height: 55px;
  float: left;
  margin-bottom: 5px;
  margin-top: 5px;
  opacity: 0.5;
  padding: 0;
  position: relative;
  transition: opacity 200ms ease;
  width: 100%;
  -webkit-transition: all 0.2s ease;
  -moz-transition: all 0.2s ease;
  -o-transition: all 0.2s ease;
  -ms-transition: all 0.2s ease;
  transition: all 0.2s ease;
}

.placeholder {
  background: #E5E5E5;
  margin:8px;
  min-height: 45px;
  position: relative;
  width: 100%;
  -webkit-transition: opacity 0.2s ease;
  -moz-transition: opacity 0.2s ease;
  -o-transition: opacity 0.2s ease;
  -ms-transition: opacity 0.2s ease;
  transition: opacity 0.2s ease;
}
.placeholder-container.active {
  opacity: 1;
}


.hover {
  background: #EEE;
  margin:8px;
  min-height: 45px;
  position: relative;
  width: 100%;
  -webkit-transition: opacity 0.2s ease;
  -moz-transition: opacity 0.2s ease;
  -o-transition: opacity 0.2s ease;
  -ms-transition: opacity 0.2s ease;
  transition: opacity 0.2s ease;
}

</style>';

    echo \Phalcon\Tag::javascriptInclude('assets/global/plugins/jquery-2.1.3.js');
    echo \Phalcon\Tag::javascriptInclude('assets/global/plugins/jquery-ui/jquery-ui-1.11.2.min.js');
    echo \Phalcon\Tag::javascriptInclude('assets/global/plugins/jquery-ui/jquery-ui-droppable-iframe-fix.js');
        
        $region=array();
        for($i=0;$i<10;$i++)
        {
            $region[$i]='<div id="row_'.$i.'" class="placeholder-container">
                <div class="placeholder">
                </div>
              </div>';
        }

        if($type=="builder")
        {
            $this->view->setVar("region", $region); 

            $this->view->setVar('class', 'dropzone-row');           
            foreach ($portlets as $portlet) {
                echo '<script> 
                $("div").find("#row_'.$portlet->row.'").append( $("<div></div>").load("/portlets/'.$portlet->type.'/render/'.$portlet->id.'/builder", function(){
                
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
