<?php
namespace PRIME\Controllers;
use PRIME\Models\ThemeLayout;
use PRIME\Models\ThemeDashboard;
use PRIME\Models\ThemePortlet;
use PRIME\Models\ThemeWidget;

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
        $themes = ThemeLayout::find();
        
        $this->view->setVar("themes", $themes);  
        
    } 

    public function createAction()
    {
        $theme = new ThemeLayout();

        $theme->name = $this->request->getPost("name");

        if(!ThemeLayout::findFirstByName($theme->name))
        {       

            if (!$theme->save()) {
                foreach ($theme->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward(array(
    "controller" => "theme_creator",
    "action"     => "index"
)
);
            }

            $this->flash->success("theme was created successfully");

            $this->dispatcher->forward(array(
                "controller" => "theme_creator",
                "action"     => "index",
                "params"=>array($theme->id)
            )
        );

        }
        else
        {

            $this->flash->error("Theme with the same name already exist");


            $this->dispatcher->forward(array(
                "controller" => "theme_creator",
                "action"     => "index"
            )
        );

        }
    
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

            $base='';
            
            foreach($css as &$url)
            {
                if (strpos($url,'//') !== false) {
                    $url='<link href="'.$url.'"></link>';
                }
                else
                {
                    $script=explode ( "/", $url);
                    $path = $_SERVER['DOCUMENT_ROOT'].'/themes/'.$theme.'/';
                    $temp=array();
                    foreach($script as $part)
                    {
                        if($part!=="..")
                        {
                            $temp[]=$part;
                        }
                    }
                    $file_name=implode( "/", array_slice($temp, -2));
                    
                        $it = new \RecursiveDirectoryIterator($path);
                        foreach(new \RecursiveIteratorIterator($it) as $file)
                        {
                            
                            
                            $file=str_replace("\\","/",$file);

                            if (strpos($file,$file_name) !== false) {
                                $file= str_replace ($_SERVER['DOCUMENT_ROOT'],"",$file);
                                $url='<link href="'.$file.'" rel="stylesheet">';
                                break;
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
            $base='';
            foreach($js as &$url)
            {
                if (strpos($url,'//') !== false) {
                    $url='<script src="'.$url.'"></script>';
                }
                else
                {
                    $script=explode ( "/", $url);
                    $path = $_SERVER['DOCUMENT_ROOT'].'/themes/'.$theme.'/';

                    $temp=array();
                    foreach($script as $part)
                    {
                    if($part!=="..")
                    {
                        $temp[]=$part;
                    }
                    
                    }
                    $file_name=implode( "/", array_slice($temp, -2));


                        $it = new \RecursiveDirectoryIterator($path);
                        foreach(new \RecursiveIteratorIterator($it) as $file)
                        {
                            $file=str_replace("\\","/",$file);
                            
                            if (strpos($file,$file_name) !== false) {
                                $file= str_replace ($_SERVER['DOCUMENT_ROOT'],"",$file);
                                $url='<script src="'.$file.'"></script>';
                                break;
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


    public function previewAction()
    {
        $this->view->disable();
        echo '<head>';
        echo $css=$this->request->getPost("css");
        echo $style=$this->request->getPost("style");
        echo '</head><body>';
        echo $html=$this->request->getPost("html");
        echo $js=$this->request->getPost("js");
        echo $script=$this->request->getPost("script");
        echo '</body>';
    }

    public function login_newAction($theme_id)
    {
        $this->tag->setDefault("theme_id", $theme_id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;
        
    }

    public function login_editAction($id)
    {
        $login=ThemeLogin::findFirstById($id);
        $theme= ThemeLayout::findFirstById($login->theme_layout_id);
        $theme=$theme->name;

        $FormElementList=\PRIME\Controllers\FormController::getFormElementList();

        $this->view->setVar("formElementList", $FormElementList); 

        $helpers=array();

        $helpers["Username"]="{{username}}";
        $helpers["Menu Items"]="{{menu}}";

        $this->view->setVar("helpers",$helpers);

        $this->view->setVar("theme_name", $theme); 
        
        
    }

    public function login_createAction()
    {
        $login = new ThemeLogin();

        $login->name = $this->request->getPost("name");
        $login->theme_layout_id = $this->request->getPost("theme_id");
        

        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("/theme_creator/index");
        }

        $this->flash->success("Login was created successfully");

        $this->response->redirect("/theme_creator/login_edit/".$login->id);

        
        
    }



    public function dashboard_newAction($theme_id)
    {
        $this->tag->setDefault("theme_id", $theme_id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;
        
    }


    public function dashboard_deleteAction($id)
    {
        $dashboard=ThemeDashboard::findFirstById($id);

        $dashboard->delete();
        
    }

    public function dashboard_editAction($id)
    {
        $dashboard=ThemeDashboard::findFirstById($id);
        $theme= ThemeLayout::findFirstById($dashboard->theme_layout_id);
        $theme=$theme->name;

        $FormElementList=\PRIME\Controllers\FormController::getFormElementList();

        $this->view->setVar("formElementList", $FormElementList); 

        $helpers=array();

        $helpers["Drop Zone Region"]="{{region.name}}";

        $helpers["Username"]="{{username}}";
        $helpers["Log Out Link"]="{{logout}}";
        $helpers["Menu Items"]="{{menu}}";

        $helpers["Parameters by Name"]="{{parm.parameter_name}}";
        $helpers["Database by Name"]="{{db.column_name}}";

        $this->view->setVar("helpers",$helpers);

        $this->view->setVar("dashboard_id", $id);

        $this->view->setVar("theme_name", $theme); 



        $css=$dashboard->css;
        $style=$dashboard->style;
        $html=$dashboard->html;
        $js=$dashboard->js;
        $script=$dashboard->script;
        $form=$dashboard->form;


        $this->view->setVar("css", $css); 
        $this->view->setVar("style", $style); 
        $this->view->setVar("html", $html); 
        $this->view->setVar("js", $js); 
        $this->view->setVar("script", $script); 
        $this->view->setVar("form", $form); 
    }

    public function dashboard_createAction()
    {
        $dashboard = new ThemeDashboard();

        $dashboard->name = $this->request->getPost("name");
        $dashboard->theme_layout_id = $this->request->getPost("theme_id");
        

        if (!$dashboard->save()) {
            foreach ($dashboard->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("/theme_creator/index");
        }

        $this->flash->success("Dashboard was created successfully");

        $this->response->redirect("/theme_creator/dashboard_edit/".$dashboard->id);
    }

    public function dashboard_saveAction($id)
    {
        $dashboard=ThemeDashboard::findFirstById($id);

        $theme= ThemeLayout::findFirstById($dashboard->theme_layout_id);
        $theme=$theme->name;

        $css=$this->request->getPost("css");
        $style=$this->request->getPost("style");
        $html=$this->request->getPost("html");
        $js=$this->request->getPost("js");
        $script=$this->request->getPost("script");
        $form=$this->request->getPost("form");

         $dashboard->css=$css;
         $dashboard->style=$style;
         $dashboard->html=$html;
         $dashboard->js=$js;
         $dashboard->script=$script;
         $dashboard->form=$form;

         $type=$dashboard->name;
        
         if (!$dashboard->save()) {
             foreach ($dashboard->getMessages() as $message) {
                 $this->flash->error($message);
             }

         }

         $this->flash->success("Dashboard was saved successfully");


        $this->view->disable();

        $controller='<?php
                    namespace PRIME\Themes\\'.\Phalcon\Text::camelize($theme).'\Dashboards;
                    use PRIME\Themes\DashboardBase as DashboardBase;

                    class '.\Phalcon\Text::camelize($type).'Controller extends DashboardBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct =\''.$form.'\';
                        }
                    }';
        
        $parms=$_POST['parms'];

        $root=str_replace("public","app",$_SERVER['DOCUMENT_ROOT']);
        
        $path = $root.'/themes/'.$theme.'/dashboards/';

        chmod($path, 0777);

        $content = $controller;
        $fp = fopen($path.\Phalcon\Text::camelize($type)."Controller.php","w");
        fwrite($fp,$content);
        fclose($fp);


        $view='<head>'.$css.$style.'</head><body>'.$html.$js.$script.'{{ content() }}</body>';

        $file_path=$path.strtolower($type)."/view.phtml";
        if(!file_exists(dirname($file_path)))
            mkdir(dirname($file_path), 0777, true);

        $fp = fopen($file_path,"w");
        fwrite($fp,$view);
        fclose($fp);


    
    }

    public function dashboard_previewAction()
    {

        $this->view->disable();
        echo '<head>';
        echo $css=$this->request->getPost("css");
        echo $style=$this->request->getPost("style");
        echo '</head><body>';
        echo $html=$this->request->getPost("html");
        echo $js=$this->request->getPost("js");
        echo $script=$this->request->getPost("script");
        echo '</body>';
        
        
    }


    public function portlet_newAction($theme_id)
    {
        $this->tag->setDefault("theme_id", $theme_id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;
        
    }

    public function portlet_deleteAction($id)
    {
        $portlet=ThemePortlet::findFirstById($id);

        $portlet->delete();
        
    }


    public function portlet_editAction($id)
    {
        $portlet=ThemePortlet::findFirstById($id);
        $theme= ThemeLayout::findFirstById($portlet->theme_layout_id);
        $theme=$theme->name;

        $FormElementList=\PRIME\Controllers\FormController::getFormElementList();

        $this->view->setVar("formElementList", $FormElementList); 


        $helpers=array();

        $helpers["Drop Zone Region"]="{{region.name}}";

        $helpers["Parameters by Name"]="{{parm.parameter_name}}";
        $helpers["Database by Name"]="{{db.column_name}}";

        $this->view->setVar("helpers",$helpers);

        $this->view->setVar("portlet_id", $id);

        $this->view->setVar("theme_name", $theme); 



        $css=$portlet->css;
        $style=$portlet->style;
        $html=$portlet->html;
        $js=$portlet->js;
        $script=$portlet->script;
        $form=$portlet->form;


        $this->view->setVar("css", $css); 
        $this->view->setVar("style", $style); 
        $this->view->setVar("html", $html); 
        $this->view->setVar("js", $js); 
        $this->view->setVar("script", $script); 
        $this->view->setVar("form", $form); 
        
        
    }

    public function portlet_createAction()
    {
        $portlet = new ThemePortlet();
        $portlet->theme_layout_id = $this->request->getPost("theme_id");
        $portlet->name = $this->request->getPost("name");

        if (!$portlet->save()) {
            foreach ($portlet->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("/theme_creator/index");
        }

        $this->flash->success("Portlet was created successfully");

        $this->response->redirect("/theme_creator/portlet_edit/".$portlet->id);

        
        
    }

    public function portlet_saveAction($id)
    {
        $portlet=ThemePortlet::findFirstById($id);

        $theme= ThemeLayout::findFirstById($portlet->theme_layout_id);
        $theme=$theme->name;

        $css=$this->request->getPost("css");
        $style=$this->request->getPost("style");
        $html=$this->request->getPost("html");
        $js=$this->request->getPost("js");
        $script=$this->request->getPost("script");
        $form=$this->request->getPost("form");

        $portlet->css=$css;
        $portlet->style=$style;
        $portlet->html=$html;
        $portlet->js=$js;
        $portlet->script=$script;
        $portlet->form=$form;

        $type=$portlet->name;
        $type=str_replace(" ","_",strtolower($type));
        
        if (!$portlet->save()) {
            foreach ($portlet->getMessages() as $message) {
                $this->flash->error($message);
            }

        }

        $this->flash->success("Portlet was saved successfully");


        $this->view->disable();


        $controller='<?php
                    namespace PRIME\Themes\\'.\Phalcon\Text::camelize($theme).'\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class '.\Phalcon\Text::camelize($type).'Controller extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct =\''.$form.'\';
                        }
                    }';
        
        $parms=$_POST['parms'];

        $root=str_replace("public","app",$_SERVER['DOCUMENT_ROOT']);
        
        $path = $root.'/themes/'.$theme.'/portlets/';

        chmod($path, 0777);

        $content = $controller;
        $fp = fopen($path.\Phalcon\Text::camelize($type)."Controller.php","w");
        fwrite($fp,$content);
        fclose($fp);


        $view=$html.$script.'{{ content() }}';

        $file_path=$path.strtolower($type)."/view.phtml";
        if(!file_exists(dirname($file_path)))
            mkdir(dirname($file_path), 0777, true);

        $fp = fopen($file_path,"w");
        fwrite($fp,$view);
        fclose($fp);


        
    }

    public function widget_newAction($theme_id)
    {
        $this->tag->setDefault("theme_id", $theme_id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;
        
    }

    public function widget_deleteAction($id)
    {
        $widget=ThemeWidget::findFirstById($id);

        $widget->delete();
        
    }

    public function widget_editAction($id)
    {
        $widget=ThemeWidget::findFirstById($id);
        $theme= ThemeLayout::findFirstById($widget->theme_layout_id);
        $theme=$theme->name;

        $FormElementList=\PRIME\Controllers\FormController::getFormElementList();

        $this->view->setVar("formElementList", $FormElementList); 

        $this->view->setVar("theme_name", $theme); 

        $helpers=array();

        $helpers["Parameters by Name"]="{{parm.parameter_name}}";
        $helpers["Database by Name"]="{{db.column_name}}";

        $this->view->setVar("helpers",$helpers);

        $this->view->setVar("widget_id", $id);

        $this->view->setVar("theme_name", $theme); 



        $css=$widget->css;
        $style=$widget->style;
        $html=$widget->html;
        $js=$widget->js;
        $script=$widget->script;
        $form=$widget->form;
        $data_format=$widget->data_format;


        $this->view->setVar("css", $css); 
        $this->view->setVar("style", $style); 
        $this->view->setVar("html", $html); 
        $this->view->setVar("js", $js); 
        $this->view->setVar("script", $script); 
        $this->view->setVar("form", $form); 
        $this->view->setVar("data_format", $data_format); 


        
        
    }

    public function widget_createAction()
    {
        $widget = new ThemeWidget();

        $widget->theme_layout_id = $this->request->getPost("theme_id");
        $widget->name = $this->request->getPost("name");
        $widget->category = $this->request->getPost("category");

        if (!$widget->save()) {
            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->response->redirect("/theme_creator/index");
        }

        $this->flash->success("widget was created successfully");

        $this->response->redirect("/theme_creator/widget_edit/".$widget->id);

        
        
    }

    public function widget_saveAction($id)
    {
        $widget=ThemeWidget::findFirstById($id);

        $theme= ThemeLayout::findFirstById($widget->theme_layout_id);
        $theme=$theme->name;

        $css=$this->request->getPost("css");
        $style=$this->request->getPost("style");
        $html=$this->request->getPost("html");
        $js=$this->request->getPost("js");
        $script=$this->request->getPost("script");
        $form=$this->request->getPost("form");
        $data_format=$this->request->getPost("data_format");


        function get_inner_html( $node ) {
            $innerHTML= '';
            $children = $node->childNodes;
            foreach ($children as $child) {
                $innerHTML .= $child->ownerDocument->saveHTML( $child );
            }
            return $innerHTML;
        } 


        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = FALSE;
        \libxml_use_internal_errors(true);
        $dom->loadHTML($html);

        $countainer="";

        if (count($dom->getElementsByTagName('body')->item(0)->childNodes) == 1)
        {
            $break=false;
            $attributes=array();
            foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $node) {
                if ($node->nodeType === XML_ELEMENT_NODE) {

                    
                    $type=$node->tagName;
                    
                    foreach($node->attributes as $attribute)
                    {
                        $temp=array();
                        $temp['name']=$attribute->name;
                        $temp['value']=$attribute->value;
                        $attributes[]=$temp;

                      if($temp['name']=='id')
                      {
                          $countainer='<div id="widget_{{widget.id}}"></div>';
                          $html_save=$html;
                          $break=true;
                          break 2;
                      }
                    }

                    $html_save=get_inner_html($node);
                    
                }
            }
            if(!$break)
            {
                $countainer="<".$type." id=\"widget_{{widget.id}}\" ";
                foreach($attributes as $attribute)
                {
                    
                    $countainer=$countainer.$attribute['name'].'="'.$attribute['value'].'" ';

                }

                $countainer=$countainer."></".$type.">";
            }
            
        }

        else
        {
            $html_save=$html;
            $countainer='<div id="widget_{{widget.id}}"></div>';

        }


        $widget->css=$css;
        $widget->style=$style;
        $widget->html=$html;
        $widget->js=$js;
        $widget->script=$script;
        $widget->form=$form;
        $widget->data_format=$data_format;

        $type=$widget->name;
        $type=str_replace(" ","_",strtolower($type));
        $category=$widget->category;
        $category=str_replace(" ","_",strtolower($category));
        
        if (!$widget->save()) {
            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }

        }

        $this->flash->success("Widget was saved successfully");


        $this->view->disable();

        $controller='<?php
namespace PRIME\Themes\\'.\Phalcon\Text::camelize($theme).'\Widgets\\'.\Phalcon\Text::camelize($category).';
use PRIME\Themes\WidgetBase as WidgetBase;

class '.\Phalcon\Text::camelize($type).'Controller extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct =\''.$form.'\';
        $this->data_format=\''.$data_format.'\';
        $this->container=\''.$countainer.'\';


    }
}';
        

        $root=str_replace("public","app",$_SERVER['DOCUMENT_ROOT']);
        
        $path = $root.'/themes/'.$theme.'/widgets/'.strtolower($category).'/';

        chmod($path, 0777);

        $content = $controller;
        $fp = fopen($path.\Phalcon\Text::camelize($type)."Controller.php","w");
        fwrite($fp,$content);
        fclose($fp);


        $view=$html_save.$script.'{{ content() }}';

        $file_path=$path.strtolower($type)."/view.phtml";
        if(!file_exists(dirname($file_path)))
            mkdir(dirname($file_path), 0777, true);

        $fp = fopen($file_path,"w");
        fwrite($fp,$view);
        fclose($fp);


        
    }

    function DOMinnerHTML(DOMNode $element) 
    { 
        $innerHTML = ""; 
        $children  = $element->childNodes;

        foreach ($children as $child) 
        { 
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML; 
    }

    public function editAction($id)
    {
        $theme = ThemeLayout::findFirstById($id);
        if (!$theme) {
            $this->flash->error("Theme was not found");

            return $this->dispatcher->forward(array(
                "controller" => "ThemeCreator",
                "action" => "index"
            ));
        }


        $this->tag->setDefault("id", $theme->id);
        $this->tag->setDefault("name", $theme->name);

        $this->view->setVar("theme_id", $theme->id);
       
        $portlets=$theme->ThemePortlet;
        $dashboards=$theme->ThemeDashboard;
        $widgets=$theme->ThemeWidget;
        $logins=$theme->ThemeLogin;
        
        $this->view->setVar("portlets", $portlets);  
 
        $this->view->setVar("dashboards", $dashboards);  

        $this->view->setVar("widgets", $widgets);  

        $this->view->setVar("logins", $logins); 


        
    }
    
    public function importAction()
    {
        
    }

    public function renderAction()
    {
        
    }

    public function newAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->persistent->parameters = null;
        
    }



    public function upload_assetsAction($theme)
    {
        function rmdir_recursive($dir) {
            foreach(scandir($dir) as $file) {
                if ('.' === $file || '..' === $file) continue;
                if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
                else unlink("$dir/$file");
            }
            rmdir($dir);
        }

        if($_FILES['zip_file']['name']) {
            $filename = $_FILES["zip_file"]["name"];
            $source = $_FILES["zip_file"]["tmp_name"];
            $type = $_FILES["zip_file"]["type"];
            $name = explode(".", $filename);
            $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
            foreach($accepted_types as $mime_type) {
                if($mime_type == $type) {
                    $okay = true;
                    break;
                }
            }
            $continue = strtolower($name[1]) == 'zip' ? true : false;
            if(!$continue) {
                $message = "The file you are trying to upload is not a .zip file. Please try again.";
            }
            /* PHP current path */
            $path = $_SERVER['DOCUMENT_ROOT'].'/themes/'.$theme.'/';  // absolute path to the directory where zipper.php is in
            $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
            $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
            $targetdir = $path . $filenoext; // target directory
            $targetzip = $path . $filename; // target zip file
            /* create directory if not exists', otherwise overwrite */
            /* target directory is same as filename without extension */
            if (is_dir($path))  rmdir_recursive ( $path);

            if (is_dir($targetdir))  rmdir_recursive ( $targetdir);
            mkdir($targetdir, 0777,true);
            /* here it is really happening */
            if(move_uploaded_file($source, $targetzip)) {
                $zip = new \ZipArchive();
                $x = $zip->open($targetzip);  // open the zip file to extract
                if ($x === true) {
                    $zip->extractTo($path); // place in the directory with same name
                    $zip->close();
                    unlink($targetzip);
                    rename ($targetdir, $path."assets");
                }
                $message = "Your .zip file was uploaded and unpacked.";
            } else {
                $message = "There was a problem with the upload. Please try again.";
            }
        }

        $this->response->redirect("/theme_creator/dashboard_edit/".$theme);
        
    
    }

    
    
    
}
