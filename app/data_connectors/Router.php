<?php
namespace PRIME\DataConnectors;

use Phalcon\Mvc\Router as PhRouter;
use Phalcon\Text as PhText;
use \Phalcon\DI as DI;

/**
 * Extended `Phalcon\Mvc\Router` to deal with namespaced controllers.
 */
class Router extends PhRouter
{
    public function __construct()
    {
        parent::__construct();
        
        $session = \Phalcon\DI::getDefault()->getSession();

        $this->setDefaultNamespace('PRIME\Controllers\\');

        $this->removeExtraSlashes(true);

            $directory ='../app/'.basename(__DIR__).'/';
            
            //get all files in specified directory
            $files = glob($directory . "*", GLOB_BRACE);
            
            $files = array_map('basename', $files);
                        
            $this->SetupNamespacedRoutes($files);
 
    }


    public function ConvertNamespace($namespace)
    {
        return __NAMESPACE__. PhText::camelize($namespace); 
    }

    private function SetupNamespacedRoutes(array $controllersSubNamespaces)
    {
        $namespacesPattern = join('|', $controllersSubNamespaces);
        $dirname=basename(__DIR__);
        //Add route for the main controller of a namespace (IndexController)
        $this
            ->add("/".$dirname."/($namespacesPattern)", ['namespace' => 1, 'controller' => 'index', 'action' => 'index'])
            ->convert('namespace', [$this, 'ConvertNamespace']);
        
        //Add route for namespaced controllers with the index action
        $this
            ->add("/".$dirname."/($namespacesPattern)/:controller", ['namespace' => 1, 'controller' => 2, 'action' => 'index'])
            ->convert('namespace', [$this, 'ConvertNamespace']);

        //Add route for namespaced controllers with a explicited action
        $this
            ->add("/".$dirname."/($namespacesPattern)/:controller/:action", ['namespace' => 1, 'controller' => 2, 'action' => 3])
            ->convert('namespace', [$this, 'ConvertNamespace']);

        //Add route for namespaced controllers with a explicited action and params
        $this
            ->add("/".$dirname."/($namespacesPattern)/:controller/:action/:params", ['namespace' => 1, 'controller' => 2, 'action' => 3, 'params' => 4])
            ->convert('namespace', [$this, 'ConvertNamespace']);
    }

}