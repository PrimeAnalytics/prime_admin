<?php
namespace PRIME\Services;

use Phalcon\Mvc\Router as PhRouter;
use Phalcon\Text as PhText;
use \Phalcon\DI as DI;

/**
 * Extended `Phalcon\Mvc\Router` to deal with namespaced controllers.
 */
class Router extends PhRouter
{
    private $theme;

    public function __construct()
    {
		
        parent::__construct();
        
        $session = \Phalcon\DI::getDefault()->getSession();

        //Set the default namespace for all controllers that doesn't match our custom routes
        //e.g '/auth/login' will route to something like 'MyApp\Controllers\AuthController::loginAction()'
        $this->setDefaultNamespace('PRIME\Controllers\\');
        
        //Our custom routes will not use slashes at the of the URIs
        $this->removeExtraSlashes(true);

        if ($session->has("auth")) {
            //Retrieve its value
            $auth = $session->get("auth");

            $this->theme=$auth['theme'];

            $directory ='../app/themes/'.$this->theme.'/widgets/';  
            //get all files in specified directory
            $files = glob($directory . "*", GLOB_ONLYDIR);    
            $files = array_map('basename', $files);
            $this->themeLevel2SetupNamespacedRoutes("widgets",$files);

            $directory ='../app/authenticators/';            
            //get all files in specified directory
            $files = glob($directory . "*", GLOB_ONLYDIR);    
            $files = array_map('basename', $files);    
            $this->level2SetupNamespacedRoutes("authenticators",$files);

            $directory ='../app/form_elements/';            
            //get all files in specified directory
            $files = glob($directory . "*", GLOB_ONLYDIR);    
            $files = array_map('basename', $files);     
            $this->level2SetupNamespacedRoutes("form_elements",$files);

            $directory ='../app/data_connectors/';            
            //get all files in specified directory
            $files = glob($directory . "*", GLOB_ONLYDIR);    
            $files = array_map('basename', $files);   
            $this->level2SetupNamespacedRoutes("data_connectors",$files);

            
            $directory ='../app/themes/'.$this->theme.'/portlets/';

            $this->themeLevel1SetupNamespacedRoutes("portlets");


            $directory ='../app/themes/'.$this->theme.'/dashboards/';
            
            $this->themeLevel1SetupNamespacedRoutes("dashboards");


            $directory ='../app/themes/'.$this->theme.'/logins/';

            $this->themeLevel1SetupNamespacedRoutes("logins");

        }

    }


    public function level2ConvertNamespace($namespace,$prefix)
    {
        
        return 'PRIME\\'.ucwords (PhText::camelize($prefix)).'\\'. PhText::camelize($namespace); 
    }


    private function level2SetupNamespacedRoutes($prefix,array $controllersSubNamespaces)
    {

        $namespacesPattern = join('|', $controllersSubNamespaces);
        
        //Add route for the main controller of a namespace (IndexController)
        $this
            ->add("/".$prefix."/($namespacesPattern)", ['namespace' => 1, 'controller' => 'index', 'action' => 'index'])
            ->convert('namespace',function ($namespace) use ($prefix){
            return $this->level2ConvertNamespace($namespace,$prefix);
    });
        
        //Add route for namespaced controllers with the index action
        $this
            ->add("/".$prefix."/($namespacesPattern)/:controller", ['namespace' => 1, 'controller' => 2, 'action' => 'index'])
            ->convert('namespace',function ($namespace) use ($prefix) {
            return $this->level2ConvertNamespace($namespace,$prefix);
    });

        //Add route for namespaced controllers with a explicited action
        $this
            ->add("/".$prefix."/($namespacesPattern)/:controller/:action", ['namespace' => 1, 'controller' => 2, 'action' => 3])
            ->convert('namespace',function ($namespace) use ($prefix){
            return $this->level2ConvertNamespace($namespace,$prefix);
    });

        //Add route for namespaced controllers with a explicited action and params
        $this
            ->add("/".$prefix."/($namespacesPattern)/:controller/:action/:params", ['namespace' => 1, 'controller' => 2, 'action' => 3, 'params' => 4])
            ->convert('namespace',function ($namespace) use ($prefix){
            return $this->level2ConvertNamespace($namespace,$prefix);
    });
    }


    public function themeLevel2ConvertNamespace($namespace,$prefix)
    {
        
        return 'PRIME\Themes\\'.ucwords ($this->theme).'\\'.ucwords ($prefix).'\\'. PhText::camelize($namespace); 
    }


    private function themeLevel2SetupNamespacedRoutes($prefix,array $controllersSubNamespaces)
    {

        $namespacesPattern = join('|', $controllersSubNamespaces);
        
        //Add route for the main controller of a namespace (IndexController)
        $this
            ->add("/".$prefix."/($namespacesPattern)", ['namespace' => 1, 'controller' => 'index', 'action' => 'index'])
            ->convert('namespace',function ($namespace) use ($prefix){
            return $this->themeLevel2ConvertNamespace($namespace,$prefix);
    });
        
        //Add route for namespaced controllers with the index action
        $this
            ->add("/".$prefix."/($namespacesPattern)/:controller", ['namespace' => 1, 'controller' => 2, 'action' => 'index'])
            ->convert('namespace',function ($namespace) use ($prefix) {
            return $this->themeLevel2ConvertNamespace($namespace,$prefix);
    });

        //Add route for namespaced controllers with a explicited action
        $this
            ->add("/".$prefix."/($namespacesPattern)/:controller/:action", ['namespace' => 1, 'controller' => 2, 'action' => 3])
            ->convert('namespace',function ($namespace) use ($prefix){
            return $this->themeLevel2ConvertNamespace($namespace,$prefix);
    });

        //Add route for namespaced controllers with a explicited action and params
        $this
            ->add("/".$prefix."/($namespacesPattern)/:controller/:action/:params", ['namespace' => 1, 'controller' => 2, 'action' => 3, 'params' => 4])
            ->convert('namespace',function ($namespace) use ($prefix){
            return $this->themeLevel2ConvertNamespace($namespace,$prefix);
    });
    }

    private function themeLevel1SetupNamespacedRoutes($namespace)
    {
        $controllersNamespace ="/".$namespace;
        
        //Add route for namespaced controllers with the index action
        $this
            ->add($controllersNamespace."/:controller", ['namespace' => 'PRIME\Themes\\'.ucwords ($this->theme).'\\'.ucwords($namespace), 'controller' => 1, 'action' => 'authenticate']);

        //Add route for namespaced controllers with a explicited action
        $this
            ->add($controllersNamespace."/:controller/:action", ['namespace' => 'PRIME\Themes\\'.ucwords ($this->theme).'\\'.ucwords($namespace), 'controller' => 1, 'action' => 2]);

        //Add route for namespaced controllers with a explicited action and params
        $this
            ->add($controllersNamespace."/:controller/:action/:params", ['namespace' => 'PRIME\Themes\\'.ucwords ($this->theme).'\\'.ucwords($namespace), 'controller' => 1, 'action' => 2, 'params' => 3]);
    }

}