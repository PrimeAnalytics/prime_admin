<?php
namespace PRIME\Themes;
use \Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Dashboard;
use PRIME\Models\Variables;
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

        




        echo '<style> @import url(http://fonts.googleapis.com/css?family=Open+Sans);

.tags {
  width: 100%;
  height: 35px;
  padding: 0.5em;
margin-bottom: 1em;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
}
.tags .tag {
  display: block;
  float: left;
  background-color: rgba(52, 152, 219, 0.5);
  padding: 0.25em 0.5em;
  border-radius: 3px;
  margin-right: 0.5em;
  margin-bottom: 0.5em;
  cursor: pointer;
}
.tags .tag.highlight {
  background-color: rgba(231, 76, 60, 0.5);
}
.tags .tag.invert {
  background-color: rgba(0, 0, 0, 0.5);
}
.tags:after {
  content: "";
  clear: both;
  display: table;
}

</style>';



        echo "<script>
    var app;
    $(document).ready(function () {
        return app.init();
    });
    app = {
        can_delete: false,
        can_delete_id: 0,
        init: function () {
            return this.bind_events();
        },
        bind_events: function () {
            $(document).on('click', '.tags .tag', function (e) {
                var index;
                index = $(this).index() + 1;
                return app.delete_tag(index);
            });
            return $(document).on('keyup', '.tags input', function (e) {
                var key;
                key = e.keyCode || e.which;
                if (key === 13 || key === 188) {
                } else if (key === 8) {
                    if ($(this).val() === '') {
                        return app.delete_tag();
                    }
                } else {
                    app.can_delete = false;
                    return $('.highlight').removeClass('highlight');
                }
            });
        },
        delete_tag: function (id) {
            if (id == null) {
                id = 0;
            }
            if (this.can_delete && id === this.can_delete_id) {

                update_dashboard($('.tags .tag.highlight').data('table'),$('.tags .tag.highlight').data('column'), \"\", \"\", \"\"); 
                $('.tags .tag.highlight').remove();
                this.can_delete = false;
                return this.can_delete_id = 0;
            } else {
                $('.tags .tag').removeClass('highlight');
                this.can_delete = true;
                if (!id) {
                    $('.tags .tag:last-of-type').addClass('highlight');
                    return this.can_delete_id = 0;
                } else {
                    $('.tags .tag:nth-of-type(' + id + ')').addClass('highlight');
                    return this.can_delete_id = id;
                }
            }
        },
        add_tag: function (table,column,value) {
            if (table !== '' && value !== '' && column !== '') {
                return $('.tags input').before('<div class=\'tag\' data-table=\"'+table+'\" data-column=\"'+column+'\">' + table + '-' +column + '</div>');
            }
        }
    };

</script>";


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
opacity: 0.5;
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
                       var links = [] ;
                       </script>';

        echo '<script>

            var variables= '.json_encode($organisation->Variables->ToArray(),true).';

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
            function clear_filters()
            {
            $.each(links, function(index, key ) {

                        links[index].default_value = "";
            
            }); 
                           $.each(links, function(index, key ) {
                            $.each(d_links, function(index_d, key_d ) {

                      if(links[index].name==d_links[index_d].name)
                      links[index].default_value= d_links[index_d].value;
                      });
                      });

            update_dashboard();
            };
            
            function update_dashboard(table_in,column_in,operator_in,value_in,widget_id)
            {  
            
            var filter_string="";
            $(\'.tags .tag\').remove();
      
            var exist=false;  

            var column_array = column_in.split(\',\');

            $.each(column_array, function(column_index, column_key) {

            $.each(links, function(index, key) {


            if( links[index].column==column_array[column_index] && links[index].table==table_in)
            {
            links[index].default_value = value_in;
            exist=true;
            }
            if(links[index].default_value != "")
            {
            app.add_tag(links[index].table,links[index].column,links[index].default_value);
            }

            }); 

            values="";

            $.each(variables, function(variable_index, variable_key) {

            if(variables[variable_index].name  ==  column_array[column_index])
                {
                values=variables[variable_index].values;
                }

            });



            if(!exist)
            {
   
            links.push({"table":table_in,"column":column_array[column_index],"operator":operator_in,"default_value":value_in,"type":"where","values":values});
            app.add_tag(table_in,column_array[column_index],value_in);
            } 
            });

            ';
            
            foreach($portlets as $portlet)
            {
                $widgets=$portlet->Widget;
            foreach ($widgets as $widget) {
                echo 'if(widget_id!='.$widget->id.'){
';
            
                echo " update_".$widget->id."(table_in,column_in); 
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

        $this->view->setVar("filters", '<label>Filters:</label><div class=\'tags\'><input style="display:none" id="dashboard_filters"  ></input></div>'); 

        $this->view->setVar("userimage", $this->user_image); 
        $this->view->setVar("username", $this->full_name); 
        $this->view->setVar("logout", "/session/end"); 
       
        $menu= $this->elements->getMenu();
        $this->view->setVar("menu", $menu); 

     
        $portlets = Portlet::find(array(
                                        'dashboard_id ='.$dashboard->id,
                                        "order" => "column"
                                    ));
        
        $this->view->setVar("dashboard", $dashboard); 
        $this->view->setVar("organisation", $organisation);

        echo \Phalcon\Tag::javascriptInclude('assets/global/plugins/jquery-2.1.3.js');
        echo \Phalcon\Tag::javascriptInclude('assets/global/plugins/jquery-ui/jquery-ui-1.11.2.min.js');

        echo ' <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/assets/plugins/gridstack/gridstack.css"/>
    <link rel="stylesheet" href="/assets/plugins/gridstack/gridstack-extra.css"/>


    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
    <script src="/assets/plugins/gridstack/gridstack.js"></script>';


        
        if($type=="builder")
        {   
            $this->builderStyle();
        }

                    for($i=0;$i<10;$i++)
                    {
                        $region[$i]='<div id="dashboard_row_'.$i.'" data-row="'.$i.'" class="dropzone-dashboard grid-stack grid-stack-12" >';
   
  

                        
                        $region[$i] .= '

                          </div>';

                        echo '
  <script type="text/javascript">
        $(function () {
            var options = {
                float: false,
                cellHeight: 20,
                verticalMargin: 5
            };
            $("#dashboard_row_'.$i.'").gridstack(options);

            $("#dashboard_row_'.$i.'").each(function () {
                var grid = $(this).data("gridstack");


                
';

                   foreach ($portlets as $portlet) {
            
                            if($portlet->row == $i)
                            {
                                $x=1;
                                $y=1;
                                $height=1;
                                $width=1;

                                if( array_key_exists("layout",$parameters))
                                {
                                    foreach($parameters["layout"] as $layout)
                                    {
                                        if( $layout["thisId"]==$portlet->id && $layout["regionId"]==$i && $layout["thisType"]=="portlet" && $layout["parentId"]==$id)
                                        {
                                            $x=$layout["x"];
                                            $y=$layout["y"];
                                            $height=$layout["h"];
                                            $width=$layout["w"];
                                            continue;
                                        }
                                    }
                                }

                                echo 'var el = grid.add_widget($("<div><div class=\"grid-stack-item-content builder-portlet\" data-type=\"'.$portlet->type.'\" data-id=\"'.$portlet->id.'\"><div id=\"portlet_'.$portlet->id.'\"></div></div></div>"),
                        '.$x.', '.$y.', '.$width.', '.$height.');
                    el.attr(\'data-this-id\', "'.$portlet->id.'");
                    el.attr(\'data-parent-id\', "'.$id.'");
                    el.attr(\'data-region-id\', "'.$i.'");
                    el.attr(\'data-this-type\', "portlet");

                 ';
                            }
                        }


                   if($type!="builder")
                   {
                       echo '

                    grid.movable(\'.grid-stack-item\', false);
                    grid.resizable(\'.grid-stack-item\', false);
                    ';
                   }
echo '
}, this);


            });



    </script> ';
                    }


                    echo'<script>
$(\'.grid-stack\').on(\'dragstop\', function (event, ui) {
    var grid = this;
    var element = event.target;
});

$(\'.grid-stack\').on(\'resizestop\', function (event, ui) {
    var grid = this;
    var element = event.target;
var items =[];
$(\'.grid-stack-item.ui-draggable\').each(function () {
var $this = $(this);
items.push({
thisId: $this.data(\'this-id\'),
parentId: $this.data(\'parent-id\'),
regionId: $this.data(\'region-id\'),
thisType: $this.data(\'this-type\'),
x: $this.attr(\'data-gs-x\'),
y: $this.attr(\'data-gs-y\'),
w: $this.attr(\'data-gs-width\'),
h: $this.attr(\'data-gs-height\')
});
});

$.post( "/dashboard/SaveLayout/'.$id.'",{"data":items}, function(data) {
});
});
</script>';



                $this->view->setVar("region", $region); 
            
            foreach ($portlets as $portlet) {
                echo '<script>
            $.post("/portlets/'.$portlet->type.'/render/'.$portlet->id.'/'.$type.'", function(data) { $("#portlet_'.$portlet->id.'").replaceWith(data); ';
                if($type=="builder"){
                    echo 'parent.update_dropzone(); 
                         


 parent.iframe_load();
';
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


        echo \Phalcon\Tag::javascriptInclude('assets/global/plugins/jquery-ui/jquery-ui-droppable-iframe-fix.js');
        echo \Phalcon\Tag::stylesheetLink("https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css");

    
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
