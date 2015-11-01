<?php
namespace PRIME\Controllers;
use PRIME\Models\Dashboard;
use PRIME\Models\DashboardHasUsers;
use PRIME\Models\Widget;
use PRIME\Models\Portlet;
use PRIME\Models\Links;
use PRIME\Models\Organisation;


class DashboardController extends ControllerBase
{
    public function initialize()
    {   
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Dashboard');
        parent::initialize();
    }


    public function indexAction()
    {
        $auth = $this->session->get("auth");
        $DashboardList=\PRIME\Controllers\GetController::getDashboardList();

        $this->view->setVar('dashboardList',$DashboardList);

        $data = Dashboard::find("organisation_id= ".$auth['organisation_id']);
        
        $this->view->setVar("dashboards", $data);  

        $data = Links::find("organisation_id= ".$auth['organisation_id']);
        
        $this->view->setVar("links", $data); 
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
    

    /**
     * Deletes a dashboard
     *
     * @param string $id
     */
    public function deleteAction()
    {
        $id = $this->request->getPost("id");
        $dashboard = Dashboard::findFirstByid($id);
        
        
        if (!$dashboard) {
            $this->flash->error("dashboard was not found");

            return $this->dispatcher->forward(array(
                "controller" => "dashboard",
                "action" => "index"
            ));
        }
       
        
        $portlets=$dashboard->Portlet;
        
        $enabledDashboards=$dashboard->DashboardHasUsers;

        foreach($portlets as $portlet)
        {
            $widgets= $portlet->Widget;
            foreach($widgets as $widget)
            {
            
                $widget->delete();
                
            }
            $portlet->delete();
            
        }

        $enabledDashboards->delete();
        
        

        if (!$dashboard->delete()) {

            foreach ($dashboard->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "dashboard",
                "action" => "index"
            ));
        }

        $this->flash->success("Dashboard was deleted successfully");

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
