<?php
namespace PRIME\Controllers;
use PRIME\Models\Dashboard;
use PRIME\Models\Widget;
use PRIME\Models\Portlet;
use PRIME\Models\Organisation;


class DashboardController extends ControllerBase
{
    public function initialize()
    {   
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Dashboard');
        parent::initialize();
        
    }
        
public function testpdoAction()
{


  $dbh = new \Crate\PDO\PDO('crate:localhost:4200', null, null, []);
  foreach($dbh->query('SELECT text FROM tweets') as $row) {
      print_r($row);
      }
  $dbh = null;
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

        $DashboardList=\PRIME\Controllers\DashboardController::getDashboardList();

        $this->view->setVar('dashboardList',$DashboardList);
        
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

            $WidgetList=\PRIME\Controllers\WidgetController::getWidgetList();

            $this->view->setVar("widgetList", $WidgetList); 

            $PortletList=\PRIME\Controllers\PortletController::getPortletList();

            $this->view->setVar("portletList", $PortletList); 

            $DashboardList=\PRIME\Controllers\DashboardController::getDashboardList();

            $this->view->setVar("dashboardList", $DashboardList); 

            $portlets = $dashboard->Portlet;
            $this->view->setVar("portlets", $portlets); 

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

    /**
     * Creates a new dashboard
     */
    public function createAction()
    {

     // Check if the user has uploaded files
        if ($this->request->hasFiles() == true) {
            $baseLocation = '/files/';

            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {          
                $file->moveTo($baseLocation . $file->getName());
            }
        }

        $dashboard = new Dashboard();

        $dashboard->title = $this->request->getPost("title");
        $dashboard->type = $this->request->getPost("type");
        $dashboard->icon = $this->request->getPost("icon");
        $dashboard->weight = $this->request->getPost("weight");
        $dashboard->organisation_id = $this->request->getPost("organisation_id");
        

        if (!$dashboard->save()) {
            foreach ($dashboard->getMessages() as $message) {
                $this->flash->error($message);
            }

           $this->response->redirect("organisation/index/");
        }

        $this->flash->success("dashboard was created successfully");

        $this->response->redirect("dashboards/".$dashboard->type."/edit/".$dashboard->id);

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

}
