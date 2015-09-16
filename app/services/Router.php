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
    public function __construct()
    {
		
        
        parent::__construct();
        
        $session = \Phalcon\DI::getDefault()->getSession();

        //Set the default namespace for all controllers that doesn't match our custom routes
        //e.g '/auth/login' will route to something like 'MyApp\Controllers\AuthController::loginAction()'
        $this->setDefaultNamespace('PRIME\Controllers\\');
        
        //Our custom routes will not use slashes at the of the URIs
        $this->removeExtraSlashes(true);

        //Register routes for all controllers that have ONE extra namespace level
        //e.g '/foo' will route to something like 'MyApp\Controllers\Foo\IndexController::indexAction()'
        //path to directory to scan

        if ($session->has("auth")) {
            //Retrieve its value
            $auth = $session->get("auth");
            $directory ='../app/widgets/'.$auth['theme'].'/';
            
            //get all files in specified directory
            $files = glob($directory . "*", GLOB_BRACE);
            
            $files = array_map('basename', $files);
                        
            $this->widgetSetupNamespacedRoutes($files);
            
        }

            $directory ='../app/data_connectors/';
            
            //get all files in specified directory
            $files = glob($directory . "*", GLOB_BRACE);
            
            $files = array_map('basename', $files);
            
            $this->dataConnectorSetupNamespacedRoutes($files);

            $this->SetupNamespacedRoutes("Authenticators");
    }

    /**
     * From the request URI receive and convert the namespace to the full namespace path.
     * @param string $namespace Namespace name in underscore format.
     * @return string Full namespace path camelized.
     */
    public function widgetConvertNamespace($namespace)
    {
        $session = \Phalcon\DI::getDefault()->getSession();
            $auth = $session->get("auth");

            return 'PRIME\Widgets\\'.ucwords ($auth['theme']).'\\'. PhText::camelize($namespace); 
    }
    /**
     * Automatically create routes for namespaced controllers.
     * @param array $controllersNamespaces array with all namespaces in underscore format.
     */
    private function widgetSetupNamespacedRoutes(array $controllersSubNamespaces)
    {
        $namespacesPattern = join('|', $controllersSubNamespaces);
        
        //Add route for the main controller of a namespace (IndexController)
        $this
            ->add("/widgets/($namespacesPattern)", ['namespace' => 1, 'controller' => 'index', 'action' => 'index'])
            ->convert('namespace', [$this, 'widgetConvertNamespace']);
            
        //Add route for namespaced controllers with the index action
        $this
            ->add("/widgets/($namespacesPattern)/:controller", ['namespace' => 1, 'controller' => 2, 'action' => 'index'])
            ->convert('namespace', [$this, 'widgetConvertNamespace']);

        //Add route for namespaced controllers with a explicited action
        $this
            ->add("/widgets/($namespacesPattern)/:controller/:action", ['namespace' => 1, 'controller' => 2, 'action' => 3])
            ->convert('namespace', [$this, 'widgetConvertNamespace']);

        //Add route for namespaced controllers with a explicited action and params
        $this
            ->add("/widgets/($namespacesPattern)/:controller/:action/:params", ['namespace' => 1, 'controller' => 2, 'action' => 3, 'params' => 4])
            ->convert('namespace', [$this, 'widgetConvertNamespace']);
    }


    /**
     * From the request URI receive and convert the namespace to the full namespace path.
     * @param string $namespace Namespace name in underscore format.
     * @return string Full namespace path camelized.
     */
    public function dataConnectorConvertNamespace($namespace)
    {
        return 'PRIME\DataConnectors\\'. PhText::camelize($namespace); 
    }
    /**
     * Automatically create routes for namespaced controllers.
     * @param array $controllersNamespaces array with all namespaces in underscore format.
     */

    private function dataConnectorSetupNamespacedRoutes(array $controllersSubNamespaces)
    {
        $namespacesPattern = join('|', $controllersSubNamespaces);
        
        //Add route for the main controller of a namespace (IndexController)
        $this
            ->add("/data_connectors/($namespacesPattern)", ['namespace' => 1, 'controller' => 'index', 'action' => 'index'])
            ->convert('namespace', [$this, 'dataConnectorConvertNamespace']);
        
        //Add route for namespaced controllers with the index action
        $this
            ->add("/data_connectors/($namespacesPattern)/:controller", ['namespace' => 1, 'controller' => 2, 'action' => 'index'])
            ->convert('namespace', [$this, 'dataConnectorConvertNamespace']);

        //Add route for namespaced controllers with a explicited action
        $this
            ->add("/data_connectors/($namespacesPattern)/:controller/:action", ['namespace' => 1, 'controller' => 2, 'action' => 3])
            ->convert('namespace', [$this, 'dataConnectorConvertNamespace']);

        //Add route for namespaced controllers with a explicited action and params
        $this
            ->add("/data_connectors/($namespacesPattern)/:controller/:action/:params", ['namespace' => 1, 'controller' => 2, 'action' => 3, 'params' => 4])
            ->convert('namespace', [$this, 'dataConnectorConvertNamespace']);
    }



    private function SetupNamespacedRoutes($namespace)
    {
        $controllersNamespace ="/".$namespace;
        
        //Add route for namespaced controllers with the index action
        $this
            ->add($controllersNamespace."/:controller", ['namespace' => 'PRIME\\'.$namespace, 'controller' => 1, 'action' => 'authenticate']);

        //Add route for namespaced controllers with a explicited action
        $this
            ->add($controllersNamespace."/:controller/:action", ['namespace' => 'PRIME\\'.$namespace, 'controller' => 1, 'action' => 2]);


        //Add route for namespaced controllers with a explicited action and params
        $this
            ->add($controllersNamespace."/:controller/:action/:params", ['namespace' => 'PRIME\\'.$namespace, 'controller' => 1, 'action' => 2, 'params' => 3]);
    }

}