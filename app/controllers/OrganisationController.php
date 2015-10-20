<?php
namespace PRIME\Controllers;
use PRIME\Models\Organisation;
use PRIME\Models\Users;
use PRIME\Models\Login;
use PRIME\Models\Dashboard;
use PRIME\Models\Widget;
use PRIME\Models\Process;
use PRIME\Models\VirtualMachine;
use PRIME\Models\OrgDatabase;
use PRIME\Models\DataConnector;
use PRIME\Models\Links;

class OrganisationController extends ControllerBase
{
    public function initialize()
    {   
        
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Organisation');
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $organisations = Organisation::find();
        
        $this->view->setVar("organisations", $organisations);  
           
}
    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    public static function getThemeList()
    {

        $data=array();

        $directory = '../app/themes/';
        //get all files in specified directory
        $files = glob($directory."*");

        foreach($files as $file)
        {
            if(is_dir($file))
            {
                $type = basename($file);
                $name = trim(implode(' ', preg_split('/(?=\p{Lu})/u', $type)));
                $data[]=$name;
            }

        }

        return $data;
    }

    /**
     * Edits a organisation
     *
     * @param string $id
     */
    public function editAction($id)
    {

            $organisation = Organisation::findFirstByid($id);
            if (!$organisation) {
                $this->flash->error("organisation was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "organisation",
                    "action" => "index"
                ));
            }


            $LoginList=\PRIME\Controllers\GetController::getLoginList();

            $this->view->setVar('loginList',$LoginList);





            $this->view->id = $organisation->id;

            $this->tag->setDefault("id", $organisation->id);
            $this->tag->setDefault("name", $organisation->name);
            
            $database = OrgDatabase::findFirstByorganisation_id($id);
            
            $this->tag->setDefault("db_id", $database->id);
            $this->tag->setDefault("db_host", $database->db_host);
            $this->tag->setDefault("db_username", $database->db_username);
            $this->tag->setDefault("db_password", $database->db_password);
            $this->tag->setDefault("db_name", $database->db_name);
            
            $this->view->setVar("organisation_id", $organisation->id);  

            $data = Login::find("organisation_id= ".$organisation->id);
            
            $this->view->setVar("logins", $data);  
            
            $data = Dashboard::find("organisation_id= ".$organisation->id);
            
            $this->view->setVar("dashboards", $data);  

            $data = Process::find("organisation_id= ".$organisation->id);
            
            $this->view->setVar("processes", $data);  

            $data = Links::find("organisation_id= ".$organisation->id);
            
            $this->view->setVar("links", $data);  

            $data = VirtualMachine::find("organisation_id= ".$organisation->id);
            
            $this->view->setVar("virtual_machines", $data); 
            
            $data = Users::find("organisation_id= ".$organisation->id);
            
            $this->view->setVar("users", $data);  


            $data = DataConnector::find("organisation_id= ". $organisation->id);
            
            $this->view->setVar("data_connectors", $data);

            $this->view->setVar("themeList", $this->getThemeList());
            

    }

    /**
     * Creates a new organisation
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "organisation",
                "action" => "index"
            ));
        }

        $organisation = new Organisation();

        $organisation->id = $this->request->getPost("id");
        $organisation->name = $this->request->getPost("name");
        $organisation->image_path = $this->request->getPost("image_path");
        

        if (!$organisation->save()) {
            foreach ($organisation->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "organisation",
                "action" => "new"
            ));
        }

        $this->flash->success("organisation was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "organisation",
            "action" => "index"
        ));

    }
    
    

    /**
     * Saves a organisation edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "organisation",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $organisation = Organisation::findFirstByid($id);
        if (!$organisation) {
            $this->flash->error("organisation does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "organisation",
                "action" => "index"
            ));
        }

        $organisation->id = $this->request->getPost("id");
        $organisation->name = $this->request->getPost("name");
        $organisation->image_path = $this->request->getPost("image_path");
        

        if (!$organisation->save()) {

            foreach ($organisation->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "organisation",
                "action" => "edit",
                "params" => array($organisation->id)
            ));
        }

        $this->flash->success("organisation was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "organisation",
            "action" => "index"
        ));

    }

    /**
     * Deletes a organisation
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $organisation = Organisation::findFirstByid($id);
        $users= $organisation->Users();
        $dashboards=$organisation->Dashboard();
        
        if (!$organisation) {
            $this->flash->error("organisation was not found");

            return $this->dispatcher->forward(array(
                "controller" => "organisation",
                "action" => "index"
            ));
        }

        if (!$organisation->delete()) {

            foreach ($organisation->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "organisation",
                "action" => "search"
            ));
        }

        $this->flash->success("organisation was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "organisation",
            "action" => "index"
        ));
    }

}
