<?php

class Security extends Phalcon\Mvc\User\Plugin
{

	/**
     * @var Phalcon\Acl\Adapter\Memory
     */
	protected $_acl;

	public function __construct($dependencyInjector)
	{
		$this->_dependencyInjector = $dependencyInjector;
	}

	public function getAcl()
	{
		if (!$this->_acl) {

			$acl = new Phalcon\Acl\Adapter\Memory();

			$acl->setDefaultAction(Phalcon\Acl::DENY);

			//Register roles
			$roles = array(
                'Admin' => new Phalcon\Acl\Role('Admin'),
                'Supervisor' => new Phalcon\Acl\Role('Supervisor'),
				'User' => new Phalcon\Acl\Role('User'),
				'Guest' => new Phalcon\Acl\Role('Guest')
			);
			foreach($roles as $role){
				$acl->addRole($role);
			}

            
            
            $adminResources = array(
                'Admin'=> array('index','organisationEdit','organisationNew','userEdit','userNew','dashboardEdit','dashboardNew','payment_methodEdit','payment_methodNew','calendar_eventEdit','calendar_eventNew','canvasEdit','canvasNew'),
			);
            
            foreach($adminResources as $resource => $actions){
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
            
            $supervisorResources = array(
               'Supervisor/index'=> array('index'),
           );
            
            foreach($supervisorResources as $resource => $actions){
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
            


            
			//User area resources
			$userResources = array(
            'Canvas' => array('builder','dashboard'),
            'widget' => array('builder','update'),
            'index' => array('*'),
            
                'dashboard' => array('index'),
				'profile' => array('edit'),
                'calendar' => array('index'),
                'report' => array('index'),
                'support' => array('index', 'send')
			);
			foreach($userResources as $resource => $actions){
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Private area resources
			$publicResources = array(
                'logins' => array('*'),
				'session' => array('index', 'register', 'start', 'end')
			);

			foreach($publicResources as $resource => $actions){
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Grant access to public areas to both users and guests
			foreach($roles as $role){
				foreach($publicResources as $resource => $actions){
					$acl->allow($role->getName(), $resource, '*');
				}
			}

			//Grant acess to private area to role Users
			foreach($userResources as $resource => $actions){
				foreach($actions as $action){
					$acl->allow('User', $resource, $action);
                    $acl->allow('Admin', $resource, $action);
                    $acl->allow('Supervisor', $resource, $action);
				}
			}
            
            foreach($supervisorResources as $resource => $actions){
				foreach($actions as $action){
                    $acl->allow('Supervisor', $resource, $action);
                    $acl->allow('Admin', $resource, $action);
				}
			}
            
            
            foreach($adminResources as $resource => $actions){
				foreach($actions as $action){
                    $acl->allow('Admin', $resource, $action);
				}
			}

			$this->_acl = $acl;
		}
		return $this->_acl;
	}

	/**
     * This action is executed before execute any action in the application
     */
	public function beforeDispatch(Phalcon\Events\Event $event, Phalcon\Mvc\Dispatcher $dispatcher)
	{
		$auth = $this->session->get('auth');
		if (!$auth){
            $auth['role']='Guest';
			$role = 'Guest';
		} else {
			$role = $auth['role'];
		}

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		$acl = $this->getAcl();

		$allowed = $acl->isAllowed($role, $controller, $action);
        if ($role=='Admin' || $role=='User'||$role=='Guest')
        {
            return true;
        }
		elseif ($allowed != Phalcon\Acl::ALLOW) {    
        if ($role!='Guest'){
			$this->flash->error("You don't have access to $controller/$action) please login to get access");
            }
			$dispatcher->forward(
				array(
                'namespace'=> 'PRIME\Controllers',
					'controller' => 'session',
					'action' => 'index'
				)
			);
			return false;
		}

	}

}