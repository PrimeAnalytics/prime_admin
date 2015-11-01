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
