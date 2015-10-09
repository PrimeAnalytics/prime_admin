<?php
namespace PRIME\Controllers;
use Phalcon\Mvc\Model\Criteria;
use PRIME\Models\Widget;
use PRIME\Models\Portlet;

class PortletController extends \Phalcon\Mvc\Controller
{    /**
     * Index action
     */
    
     
    public function indexAction()
    {
    $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($dashboard_id, $row,$column)
    {
    $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $directory = '../app/themes/'.$auth['theme'].'/portlets/';
        }
        
        //get all files in specified directory
        $files = glob($directory . "*.{phtml}", GLOB_BRACE);
        
        $files = array_map('basename', $files);
        
        $files = array_map(function($value) { return str_replace('.phtml', '', $value); }, $files);
        
        $files = array_combine($files, $files);

        $this->view->setVar("files", $files);

        $this->tag->setDefault("row", $row);
        $this->tag->setDefault("column", $column);
        $this->tag->setDefault("dashboard_id", $dashboard_id);
    }
    
    public function renderAction($id, $type)
    {
    $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

    
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->view->setViewsDir('../app/themes/'.$auth['theme'].'/');
        }
        
        $widgets = Widget::find(array(
                    'canvas_id ='.$id,
                    "order" => "column"
                ));

       $canvas = Canvas::findFirstByid($id);

       $this->view->pick(strtolower("canvas/".$canvas->style));
       
       if($type=="builder")
       {
           $this->view->setVar('class', 'dropzone-canvas');
       }
       
       else
       {
           $this->view->setVar('class', 'row');
       }
       
       echo '<script>';

        foreach ($widgets as $widget) {

            echo ' $("div[data-canvasRowNumber='.$widget->row.' ][data-canvasID= '.$widget->canvas_id.' ]").append($("<div>").load("/widgets/'.$widget->type.'/'.$type.'/'.$widget->id.'"));';

        }
        
        echo '</script>';
        

       $this->view->setVar("canvas_width", $canvas->width);  
       $this->view->setVar("canvas_title", $canvas->title);  
       $this->view->setVar("canvas_id", $canvas->id);  
    }

    /**
     * Edits a canva
     *
     * @param string $id
     */
    public function editAction($id)
    {
    $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        if (!$this->request->isPost()) {

            $canvas = Canvas::findFirstByid($id);
            if (!$canvas) {
                $this->flash->error("canvas was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "canvas",
                    "action" => "index"
                ));
            }
      
            

            $this->view->id = $canvas->id;

            $this->tag->setDefault("id", $canvas->id);
            $this->tag->setDefault("style", $canvas->style);
            $this->tag->setDefault("title", $canvas->title);
            $this->tag->setDefault("width", $canvas->width);
            $this->tag->setDefault("column", $canvas->column);
            $this->tag->setDefault("row", $canvas->row);
            $this->tag->setDefault("dashboard_id", $canvas->dashboard_id);
            
        }
    }

    /**
     * Creates a new canva
     */
    public function createAction()
    {
        $canvas = new Canvas();

        $canvas->style = $this->request->getPost("style");
        $canvas->title = $this->request->getPost("title");
        $canvas->width = $this->request->getPost("width");
        $canvas->column = $this->request->getPost("column");
        $canvas->row = $this->request->getPost("row");
        $canvas->dashboard_id = $this->request->getPost("dashboard_id");
        
        if ($canvas->save()) {
            $this->flash->success("Canvas was created successfully");
        }
        
        return $this->dispatcher->forward(array(
     "controller" => "dashboard",
     "action"     => "edit",
     "params"     => array('id' => $canvas->dashboard_id)
 ));

    }

    /**
     * Saves a canva edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "canvas",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $canvas = Canvas::findFirstByid($id);
        if (!$canvas) {
            $this->flash->error("canvas does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "canvas",
                "action" => "index"
            ));
        }

        $canvas->style = $this->request->getPost("style");
        $canvas->title = $this->request->getPost("title");
        $canvas->width = $this->request->getPost("width");
        $canvas->column = $this->request->getPost("column");
        $canvas->row = $this->request->getPost("row");
        $canvas->dashboard_id = $this->request->getPost("dashboard_id");
        
        
        
        if (!$canvas->save()) {
            foreach ($canvas->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
        else{
            
            $this->flash->success("Canavas was updated successfully");
            
        }
        
        return $this->dispatcher->forward(array(
     "controller" => "dashboard",
     "action"     => "edit",
     "params"     => array('id' => $canvas->dashboard_id)
 ));
        
        

    }
    
    
    public function deleteAction($id)
    {
    $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->tag->setDefault('id', $id);
        
    }
    
    
    public function deletePortletAction()
    {
        $id = $this->request->getPost("id");
        $canvas = Canvas::findFirstByid($id);
        $widgets=$canvas->Widget;
        
        
        foreach($widgets as $widget)
        {
            $widget->delete();
        }
        

        if (!$canvas->delete()) {

            foreach ($canvas->getMessages() as $message) {
                $this->flash->error($message);
            }

        }
        else
        {
            $this->flash->success("Portlet was deleted successfully");
        }

        return $this->dispatcher->forward(array(
     "controller" => "dashboard",
     "action"     => "edit",
     "params"     => array('id' => $canvas->dashboard_id)
 ));
    }
    
    public static function getPortletList()
    {
        $theme = $_SESSION["auth"]['theme'];

        $data=array();

                $subdirectory = '../app/themes/'.$theme.'/portlets/';
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
