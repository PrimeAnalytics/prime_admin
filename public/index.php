<?php

error_reporting(-1);
try {

	//Read the configuration
	$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../app/config/config.ini');
    

	$loader = new \Phalcon\Loader();

	/**
	 * We're a registering a set of directories taken from the configuration file
	 */
    $loader->registerDirs(
    array(
        __DIR__.$config->application->pluginsDir,
        __DIR__.$config->application->libraryDir

    )
);
    $loader->register();
      
    $loader->registerNamespaces(array(
        'PRIME\Authenticators' =>    __DIR__.$config->application->authenticatorsDir,
        'PRIME\DataConnectors' =>    __DIR__.$config->application->dataConnectorsDir,
        'PRIME\FormElement' =>    __DIR__.$config->application->formElementDir,
        'PRIME\Themes' =>    __DIR__.$config->application->themesDir,
	'PRIME\Controllers' =>    __DIR__.$config->application->controllersDir,
    'PRIME\Services' =>       __DIR__.$config->application->servicesDir,
    'PRIME\Models' =>     __DIR__.$config->application->modelsDir
))->register();
    
    require __DIR__ . '/../vendor/autoload.php';
	/**
	 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
	 */
	$di = new \Phalcon\DI\FactoryDefault();
    

	/**
	 * We register the events manager
	 */
	$di->set('dispatcher', function() use ($di) {

		$eventsManager = $di->getShared('eventsManager');

		$security = new Security($di);

		/**
		 * We listen for events in the dispatcher using the Security plugin
         */
		$eventsManager->attach('dispatch', $security);

		$dispatcher = new Phalcon\Mvc\Dispatcher();
		$dispatcher->setEventsManager($eventsManager);

        $dispatcher->setDefaultNamespace('\Controllers');
        
		return $dispatcher;
	});

	/**
	 * The URL component is used to generate all kind of urls in the application
	 */
	$di->set('url', function() use ($config){
		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri($config->application->baseUri);
		return $url;
	});


	$di->set('view', function() use ($config) {
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir(__DIR__.$config->application->viewsDir);
		return $view;
	});
    
	/**
	 * Database connection is created based in the parameters defined in the configuration file
	 */
	$di->set('db', function() use ($config) {
		return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->dbname
		));
	});
    
    
    \Phalcon\DI::setDefault( $di );
    

	/**
	 * If the configuration specify the use of metadata adapter use it or use memory otherwise
	 */
	$di->set('modelsMetadata', function() use ($config) {
		if(isset($config->models->metadata)){
			$metaDataConfig = $config->models->metadata;
			$metadataAdapter = 'Phalcon\Mvc\Model\Metadata\\'.$metaDataConfig->adapter;
			return new $metadataAdapter();
		} else {
			return new Phalcon\Mvc\Model\Metadata\Memory();
		}
	});

    //Start the session the first time some component request the session service
	$di->set('session', function(){
		$session = new Phalcon\Session\Adapter\Files();
		$session->start();
		return $session;
	}, TRUE);

     
    
    $di->set('router', 'PRIME\Services\Router');

	//Register the flash service with custom CSS classes
	$di->set('flash', function(){
		$flash = new Phalcon\Flash\Direct(array(
			'error' => 'alert alert-error',
			'success' => 'alert alert-success',
			'notice' => 'alert alert-info',
		));
		return $flash;
	});

	//Register a user component
	$di->set('elements', function(){
		return new Elements();
	});

	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e){
	echo $e->getMessage();
}
