<?php
 
namespace PRIME\Controllers;

class OrgDatabaseController extends ControllerBase
{
    public function initialize()
    {   
        
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Database');
        parent::initialize();
    }
    
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a database
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $database = OrgDatabase::findFirstByid($id);
            if (!$database) {
                $this->flash->error("database was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "database",
                    "action" => "index"
                ));
            }

            $this->view->id = $database->id;

            $this->tag->setDefault("id", $database->id);
            $this->tag->setDefault("db_host", $database->db_host);
            $this->tag->setDefault("db_username", $database->db_username);
            $this->tag->setDefault("db_password", $database->db_password);
            $this->tag->setDefault("db_name", $database->db_name);
            $this->tag->setDefault("organisation_id", $database->organisation_id);
            
        }
    }

    /**
     * Creates a new database
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "database",
                "action" => "index"
            ));
        }

        $database = new OrgDatabase();

        $database->db_host = $this->request->getPost("db_host");
        $database->db_username = $this->request->getPost("db_username");
        $database->db_password = $this->request->getPost("db_password");
        $database->db_name = $this->request->getPost("db_name");
        $database->organisation_id = $this->request->getPost("organisation_id");
        

        if (!$database->save()) {
            foreach ($database->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "database",
                "action" => "new"
            ));
        }

        $this->flash->success("database was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "database",
            "action" => "index"
        ));

    }

    /**
     * Saves a database edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "database",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $database = OrgDatabase::findFirstByid($id);
        if (!$database) {
            $this->flash->error("database does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "database",
                "action" => "index"
            ));
        }

        $database->db_host = $this->request->getPost("db_host");
        $database->db_username = $this->request->getPost("db_username");
        $database->db_password = $this->request->getPost("db_password");
        $database->db_name = $this->request->getPost("db_name");
        $database->organisation_id = $this->request->getPost("organisation_id");
        

        if (!$database->save()) {

            foreach ($database->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "database",
                "action" => "edit",
                "params" => array($database->id)
            ));
        }

        $this->flash->success("database was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "database",
            "action" => "index"
        ));

    }

    /**
     * Deletes a database
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $database = OrgDatabase::findFirstByid($id);
        if (!$database) {
            $this->flash->error("database was not found");

            return $this->dispatcher->forward(array(
                "controller" => "database",
                "action" => "index"
            ));
        }

        if (!$database->delete()) {

            foreach ($database->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "database",
                "action" => "search"
            ));
        }

        $this->flash->success("database was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "database",
            "action" => "index"
        ));
    }

}
