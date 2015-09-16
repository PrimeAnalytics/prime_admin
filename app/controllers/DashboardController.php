<?php
namespace PRIME\Controllers;
use PRIME\Models\Dashboard;
use PRIME\Models\Widget;
use PRIME\Models\Canvas;
use PRIME\Models\Organisation;

class DashboardController extends ControllerBase
{
    public function initialize()
    {   
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Dashboard');
        parent::initialize();
        
    }
         
    public function getLinksAction($id)
    {
        $this->view->disable();
        $dashboard = Dashboard::findFirstByid($id);   
        echo $dashboard->links;
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

    /**
     * Displays the creation form
     */
    public function newAction($organisation_id)
    {
        $organisation = Organisation::findFirstByid($organisation_id);   
        
        $this->view->setVar('theme',$organisation->theme);
        
        $this->tag->setDefault("weight", "0");
        $this->tag->setDefault("organisation_id", $organisation_id);
        
        $this->view->setTemplateAfter('');
    }

    /**
     * Edits a dashboard
     *
     * @param string $id
     */
    public function editAction($id)
    {
            $dashboard = Dashboard::findFirstByid($id);
            
            $organisation = Organisation::findFirstByid($dashboard->organisation_id);
            $this->view->setVar('theme',$organisation->theme);
            
            echo " <script>
                       var links = $dashboard->links ;
                       </script>";
            
            $canvas = $dashboard->Canvas;
            
            $this->view->setVar("canvas", $canvas); 

            $this->view->setVar("dashboard_id", $dashboard->id);  
            $this->view->setVar("links", $dashboard->links);
            $this->view->setVar("organisation_id", $dashboard->organisation_id);
            
            $this->view->id = $dashboard->id;
            
            $this->tag->setDefault("style", $dashboard->style);
            $this->tag->setDefault("id", $dashboard->id);
            $this->tag->setDefault("title", $dashboard->title);
            $this->tag->setDefault("icon", $dashboard->icon);
            $this->tag->setDefault("weight", $dashboard->weight);
            $this->tag->setDefault("organisation_id", $dashboard->organisation_id);
            
    }
    
    
    
    public function renderAction($id,$type,$links=null,$table_append="")
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
               echo '<link rel="stylesheet" href="/assets/plugins/sinister/sinister.css"> 
                    <link href="/assets/plugins/page-builder/css/style.css" rel="stylesheet"></link>
                    ';
           
                foreach ($canvas as $canvasItem) {
                echo '<script> 
              $("div").find("[data-rowNumber='.$canvasItem->row.']").before(\'<div class="placeholder-container"><div class="placeholder"><div class="placeholder-content ui-droppable"><div class="placeholder-content-area">\');
                $("div").find("[data-rowNumber='.$canvasItem->row.']").append( $("<div></div>").load("/Canvas/render/'.$canvasItem->id.'/builder", function(){
                
                parent.update_dropzone();
                
                }));
                $("div").find("[data-rowNumber='.$canvasItem->row.']").after(\'</div></div></div><div class="placeholder-handle"><div class="handle-move" data-rel="tooltip" data-placement="right" data-original-title="Move"><i class="fa fa-bars"></i></div><div class="handle-remove" data-rel="tooltip" data-placement="right" data-original-title="Remove"><a href="/canvas/delete/'.$canvasItem->id.'"><i class="fa fa-times"></i></a></div></div></div>\');
                
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

    /**
     * Creates a new dashboard
     */
    public function createAction()
    {
        $dashboard = new Dashboard();

        $dashboard->title = $this->request->getPost("title");
        $dashboard->style = $this->request->getPost("style");
        $dashboard->icon = $this->request->getPost("icon");
        $dashboard->weight = $this->request->getPost("weight");
        $dashboard->organisation_id = $this->request->getPost("organisation_id");
        $dashboard->links = "[]";
        

        if (!$dashboard->save()) {
            foreach ($dashboard->getMessages() as $message) {
                $this->flash->error($message);
            }

           $this->response->redirect("organisation/index/");
        }

        $this->flash->success("dashboard was created successfully");

        $this->response->redirect("dashboard/edit/".$dashboard->id);

    }

    /**
     * Saves a dashboard edited
     *
     */
    public function saveAction()
    {
        $id = $this->request->getPost("id");

        $dashboard = Dashboard::findFirstByid($id);
        if (!$dashboard) {
            $this->flash->error("dashboard does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "dashboard",
                "action" => "edit",
                "params" => array($dashboard->id)
            ));
        }

        $dashboard->title = $this->request->getPost("title");
        $dashboard->icon = $this->request->getPost("icon");
        $dashboard->style = $this->request->getPost("style");
        $dashboard->weight = $this->request->getPost("weight");
        $dashboard->organisation_id = $this->request->getPost("organisation_id");
        $dashboard->links = $this->request->getPost("links");
        

        if (!$dashboard->save()) {

            foreach ($dashboard->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "dashboard",
                "action" => "edit",
                "params" => array($dashboard->id)
            ));
        }

        $this->flash->success("dashboard was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "dashboard",
            "action" => "edit",
            "params" => array($dashboard->id)
        ));

    }
    
    public function deleteAction($id)
    {
        $this->tag->setDefault('id', $id);
        
    }

    /**
     * Deletes a dashboard
     *
     * @param string $id
     */
    public function deleteDashboardAction()
    {
        $id = $this->request->getPost("id");
        $dashboard = Dashboard::findFirstByid($id);
        $canvas=$dashboard->Canvas();
        
        foreach($canvas as $canva)
        {
            $widgets= $canva->Widget();
            foreach($widgets as $widget)
            {
            
                $widget->delete();
                
            }
            $canva->delete();
            
        }
        
        if (!$dashboard) {
            $this->flash->error("dashboard was not found");

            return $this->dispatcher->forward(array(
                "controller" => "dashboard",
                "action" => "index"
            ));
        }

        if (!$dashboard->delete()) {

            foreach ($dashboard->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "dashboard",
                "action" => "search"
            ));
        }

        $this->flash->success("dashboard was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "dashboard",
            "action" => "index"
        ));
    }

}
