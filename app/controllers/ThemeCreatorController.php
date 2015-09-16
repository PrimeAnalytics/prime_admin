<?php
namespace PRIME\Controllers;

class ThemeCreatorController extends ControllerBase
{
    protected function initialize()
    {
        \Phalcon\Tag::prependTitle('PRIME | ');
        $this->view->setViewsDir('../app/views/');
        $this->view->setLayoutsDir('/layouts/');
        $this->view->setTemplateAfter('main');
    }
    
    public function indexAction()
    {           
        
        
    } 

    public function inteli_formatAction($theme,$type)
    {  
        $this->view->disable();
        $postdata = file_get_contents("php://input");
        $html=(string)$postdata;
        $dom = new \DOMDocument;
        \libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        
        if($type=="css")
        {
            $nodes = $dom->getElementsByTagName('link');
            $css=array();
            foreach($nodes as $node){
                $css[]=$node->getAttribute('href');
            }


            foreach($css as &$url)
            {
                if (strpos($url,'//') !== false) {
                    $url='<link href="'.$url.'"></link>';
                }
                else
                {
                    $script=explode ( "/", $url);
                    $path = str_replace ('public','',$_SERVER['DOCUMENT_ROOT']).'app/themes/'.$theme.'/';
                    $it = new \RecursiveDirectoryIterator($path);
                    $file_name=end($script);
                    foreach(new \RecursiveIteratorIterator($it) as $file)
                    {
                        if (strpos($file,$file_name) !== false) {
                            $file= str_replace (substr_replace($path ,"",-1),"",$file);
                            $url='<link href="'.'/../app/themes/'.$theme.str_replace("\\","/",$file).'" rel="stylesheet">';
                        }
                    }
                    
                }
            }
            

            echo implode("\r\n",$css);
        }
        else if ($type=="js")
        {
            $nodes = $dom->getElementsByTagName('script');
            $js=array();
            foreach($nodes as $node){
                if($node->getAttribute('src'))
                {
                    $js[]=$node->getAttribute('src');
                }
            }

            foreach($js as &$url)
            {
                if (strpos($url,'//') !== false) {
                    $url='<script src="'.$url.'"></script>';
                }
                else
                {
                    $script=explode ( "/", $url);
                    $path = str_replace ('public','',$_SERVER['DOCUMENT_ROOT']).'app/themes/'.$theme.'/';
                    $it = new \RecursiveDirectoryIterator($path);
                    $file_name=end($script);
                    foreach(new \RecursiveIteratorIterator($it) as $file)
                    {
                        if (strpos($file,$file_name) !== false) {
                            $file= str_replace (substr_replace($path ,"",-1),"",$file);
                            $url='<script src="'.'/../app/themes/'.$theme.str_replace("\\","/",$file).'"></script>';
                        }
                    }
                    
                }
            }
            echo implode("\r\n",$js);
        }
        else if ($type=="body")
        {
            $script = $dom->getElementsByTagName('script');
            $link = $dom->getElementsByTagName('link');

            $remove = [];
            foreach($script as $item)
            {
                $remove[] = $item;
            }
            foreach($link as $item)
            {
                $remove[] = $item;
            }

            foreach ($remove as $item)
            {
                $item->parentNode->removeChild($item); 
            }
            
            $nodes = $dom->getElementsByTagName('body');
            $node=$nodes[0];
            echo $node->ownerDocument->saveHTML($node);

        }
        else if ($type=="style")
        {
            $nodes = $dom->getElementsByTagName('style');
            foreach($nodes as $node){
                echo $node->ownerDocument->saveHTML($node);
            }
        }

        else if ($type=="script")
        {
            $nodes = $dom->getElementsByTagName('script');

            $script=array();
            foreach($nodes as $node){
                if($node->getAttribute('src'))
                {
            
                }
                else
                {
                    echo $node->ownerDocument->saveHTML($node);
                }
            }
        }
       
        
    } 


    public function layout_editorAction()
    {

        
        
    }
    public function explorerAction()
    {
        
    }

    public function editAction()
    {
        
    }
    
    public function importAction()
    {
        
    }

    public function renderAction()
    {
        
    }

    public function newAction()
    {
        
    }

    public function newDashboardAction()
    {
        
    }

    public function newCanvasAction()
    {
        
    }

    public function newWidgetAction()
    {
        
    }
    
    
    
}
