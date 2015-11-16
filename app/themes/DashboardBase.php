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
    public $theme="";
    public $user_image="";
    public $full_name="";
    
    function onConstruct()
    {
        $this->dashboard_type = $this->router->getControllerName();
        
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
            $this->theme= $auth['theme'];
            $this->user_image= $auth['image_path'];
            $this->full_name= $auth['full_name'];
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

        echo '
<style> .widget-control {float:right; margin: .4em;
  padding: .3em 1em .3em 1em;
  cursor: pointer;
  background: #ececec;
  text-decoration: none;
  color: #666;} </style>
<style>.ajax-loader {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
background: white;
opacity: 0.7;
  margin: auto; /* presto! */
}
.ajax-spinner-bars {
  position:absolute;
  width:35px;
  height:35px;
  left:50%;
  top:50%;
}
.ajax-spinner-bars > div {
	position: absolute;
	width: 2px;
	height: 8px;
	background-color: #25363F;
	opacity: 0.05;
  animation: fadeit 0.8s linear infinite;
}
.ajax-spinner-bars > .bar-1 {
  transform: rotate(0deg) translate(0, -12px);
  animation-delay:0.05s;
}
.ajax-spinner-bars > .bar-2 {
  transform: rotate(22.5deg) translate(0, -12px);
  animation-delay:0.1s;
}
.ajax-spinner-bars > .bar-3 {
  transform: rotate(45deg) translate(0, -12px);
  animation-delay:0.15s;
}
.ajax-spinner-bars > .bar-4 {
  transform: rotate(67.5deg) translate(0, -12px);
  animation-delay:0.2s;
}
.ajax-spinner-bars > .bar-5 {
  transform: rotate(90deg) translate(0, -12px);
  animation-delay:0.25s;
}
.ajax-spinner-bars > .bar-6 {
  transform: rotate(112.5deg) translate(0, -12px);
  animation-delay:0.3s;
}
.ajax-spinner-bars > .bar-7 {
  transform: rotate(135deg) translate(0, -12px);
  animation-delay:0.35s;
}
.ajax-spinner-bars > .bar-8 {
  transform: rotate(157.5deg) translate(0, -12px);
  animation-delay:0.4s;
}
.ajax-spinner-bars > .bar-9 {
  transform: rotate(180deg) translate(0, -12px);
  animation-delay:0.45s;
}
.ajax-spinner-bars > .bar-10 {
  transform: rotate(202.5deg) translate(0, -12px);
  animation-delay:0.5s;
}
.ajax-spinner-bars > .bar-11 {
  transform: rotate(225deg) translate(0, -12px);
  animation-delay:0.55s;
}
.ajax-spinner-bars > .bar-12 {
  transform: rotate(247.5deg) translate(0, -12px);
  animation-delay:0.6s;
}
.ajax-spinner-bars> .bar-13 {
  transform: rotate(270deg) translate(0, -12px);
  animation-delay:0.65s;
}
.ajax-spinner-bars > .bar-14 {
  transform: rotate(292.5deg) translate(0, -12px);
  animation-delay:0.7s;
}
.ajax-spinner-bars > .bar-15 {
  transform: rotate(315deg) translate(0, -12px);
  animation-delay:0.75s;
}
.ajax-spinner-bars> .bar-16 {
  transform: rotate(337.5deg) translate(0, -12px);
  animation-delay:0.8s;
}
@keyframes fadeit{
	0%{ opacity:1; }
	100%{ opacity:0;}
}

</style>';
        $portlets=$dashboard->Portlet;
        
        echo ' <script>
                       var links = '.json_encode($organisation->Links->toArray()).' ;
                       </script>';


        echo '<script>
                var d_links = "'.$links.'";
                $.each(links, function(index, key ) {
                $.each(d_links, function(index_d, key_d ) {

          if(links[index].name==d_links[index_d].name)
          links[index].default_value= d_links[index_d].value;
          });
          });
            </script>
            ';
                
            
            echo '<script>
            
            function update_dashboard(link_id, value,widget_id)
            {  
      
            $.each(links, function(index, key ) {
            if( links[index].id==link_id)

            links[index].default_value = value;

            }); 
            ';
            
            foreach($portlets as $portlet)
            {
                $widgets=$portlet->Widget;
            foreach ($widgets as $widget) {
                echo 'if(widget_id!='.$widget->id.'){
';
            
                echo " update_".$widget->id."(link_id); 
            }
";
                
            }
            }

            echo '};
            </script>';



        $this->view->pick(strtolower($dashboard->type."/view"));
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $parameters= (array)json_decode($dashboard->parameters,true);

        $this->view->setVar("parm", $parameters); 

        

        $this->view->setVar("userimage", $this->user_image); 
        $this->view->setVar("username", $this->full_name); 
        $this->view->setVar("logout", "/session/end"); 
       
        $menu= $this->elements->getMenu();
        $this->view->setVar("menu", $menu); 

        $links = $organisation->Links;

        $this->view->setVar("links", $links); 
     
        $portlets = Portlet::find(array(
                                        'dashboard_id ='.$dashboard->id,
                                        "order" => "column"
                                    ));
        
        $this->view->setVar("dashboard", $dashboard); 
        $this->view->setVar("organisation", $organisation);
        
        $this->view->setVar("links", $organisation->Links); 

                if($type=="builder")
                {
                    $this->builderStyle();

                    for($i=0;$i<10;$i++)
                    {
                        $region[$i]='<div id="dashboard_row_'.$i.'" data-row="'.$i.'" class="dropzone-dashboard">
                          </div>';
                    }
                }
                else
                {
        
                    for($i=0;$i<10;$i++)
                    {
                        $region[$i]='<div id="dashboard_row_'.$i.'" data-row="'.$i.'">
                          </div>';
                    }
        
                }

                $this->view->setVar("region", $region); 

            
            foreach ($portlets as $portlet) {
                echo '<script>
            $.post("/portlets/'.$portlet->type.'/render/'.$portlet->id.'/'.$type.'", function(data) {';
                if($type=="builder"){
                    echo '$("#dashboard_row_'.$portlet->row.'").append("<div class=\'builder-portlet\' data-type=\"'.$portlet->type.'\" data-id=\"'.$portlet->id.'\" ><div id=\'portlet_'.$portlet->id.'\'><div><div>");';
                    }
                    else
                {
                    echo '$("#dashboard_row_'.$portlet->row.'").append("<div id=\'portlet_'.$portlet->id.'\'><div>");';
                }
                echo'$("#portlet_'.$portlet->id.'").replaceWith(data);';
                if($type=="builder"){
                    echo 'parent.update_dropzone(); 
                          parent.iframe_load();';
                 }
            echo "}); </script>";
            };
    

    }

    function builderStyle()
    {
    
        echo '<style>
 .dropzone-dashboard {
  background-color: #ffffff;
  min-height: 55px;
  float: left;
  margin-bottom: 5px;
  margin-top: 5px;
  opacity: 0.9;
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

.dropzone-dashboard.active {
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

        echo '<style>
 .dropzone-portlet {
  background-color: #ffffff;
  min-height: 55px;
  float: left;
  margin-bottom: 5px;
  margin-top: 5px;
  opacity: 0.9;
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

.dropzone-portlet.active {
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
    
    }


    public function newAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;

        $this->view->setViewsDir('../app/views/');
        $this->view->pick('dashboards/new');

        $formController = new \PRIME\Controllers\FormController();
        $form_body= $formController->renderAction($this->form_struct);

        $this->view->setVar("form_body", $form_body);
        $this->view->setVar("type", $this->dashboard_type);

        $form_type='/dashboards/'.$this->dashboard_type.'/create';
        $this->view->setVar("form_type", $form_type);
        
        
        $this->tag->setDefault("weight","0");

        $this->tag->setDefault("organisation_id",$this->organisation_id);


        
 
    }

    public function createAction()
    {
        $dashboard = new Dashboard();

        $dashboard->type = $this->dashboard_type;
        $dashboard->title = $this->request->getPost("title");
        $dashboard->icon = $this->request->getPost("icon");
        $dashboard->weight = $this->request->getPost("weight");
        $dashboard->organisation_id = $this->request->getPost("organisation_id");

        $dashboard->parameters = json_encode($this->request->getPost("parameters"));

        if (!$dashboard->save()) {
            foreach ($dashboard->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else
        {
            $this->flash->success("Dashboard was created successfully");
            
                 // Check if the user has uploaded files
            if ($this->request->hasFiles() == true) {
                $baseLocation = '/files/';

                // Print the real file names and sizes
                foreach ($this->request->getUploadedFiles() as $file) {
                    $ext = end((explode(".", $file->getName())));          
                    $file->moveTo($baseLocation ."dashboard_".$dashboard->id.".".$ext);
                }
            }


            return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Themes\\".$this->theme."\dashboards",
            "controller" => $dashboard->type,
            "action"     => "edit",
            "params"     => array('id' => $dashboard->id)
            ));
        }
    }

 
    
}
