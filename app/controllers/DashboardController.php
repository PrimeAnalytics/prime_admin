<?php
namespace PRIME\Controllers;
use PRIME\Models\Dashboard;
use PRIME\Models\Widget;
use PRIME\Models\Portlet;
use PRIME\Models\Variables;
use PRIME\Models\Organisation;
use PRIME\Models\ThemeLayout;
use PRIME\Models\ThemeDashboard;


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

        $this->view->setVar('dashboardList',$this->getDashboardList());

        $data = Dashboard::find("organisation_id= ".$auth['organisation_id']);
        
        $this->view->setVar("dashboards", $data);  

        $data = Variables::find("organisation_id= ".$auth['organisation_id']);
        
        $this->view->setVar("variables", $data); 
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


    public function SaveLayoutAction($id)
    {
        $this->view->Disable();

        $dashboard = Dashboard::findFirstByid($id);
        if (!$dashboard) {
            return;
        }
        $parm =json_decode($dashboard->parameters,true);

        $parm["layout"] = $this->request->getPost("data");
        
        $dashboard->parameters =json_encode($parm,true);

        if (!$dashboard->save()) {

            return;
        }

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
        $theme_layout = ThemeLayout::findFirstByName($theme);
        
        echo count($theme_layout);

        $dashboards=$theme_layout->ThemeDashboard;

        return $dashboards;
    }


    public function GetWidgetsListAction($id)
    {
        $this->view->Disable();

        $dashboard = Dashboard::findFirstByid($id);   
        
        $json = array();
            $portlets=$dashboard->Portlet;
            foreach($portlets as $portlet)
            {
                $widgets=$portlet->Widget;
                foreach($widgets as $widget)
                {
                    $json[] = array(
                            'id' => $widget->id,
                                       'text' => $widget->id
                                     );
                }
            }

        
        echo json_encode($json);

    }

}
