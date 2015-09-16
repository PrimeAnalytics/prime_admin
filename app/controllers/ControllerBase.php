<?php
namespace PRIME\Controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Tag as Tag;

class ControllerBase extends Controller
{
    
    protected function initialize()
    {
        \Phalcon\Tag::prependTitle('PRIME | ');
        $this->view->setViewsDir('../app/views/');
        $this->view->setLayoutsDir('/layouts/');
    }

    protected function forward($uri){
        $uriParts = explode('/', $uri);
        return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0], 
                'action' => $uriParts[1]
            )
        );
    }
}
