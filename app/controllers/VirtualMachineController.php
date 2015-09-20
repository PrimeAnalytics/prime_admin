<?php
namespace PRIME\Controllers;
use PRIME\Models\VirtualMachines;

class VirtualMachineController extends ControllerBase
{
    public function initialize()
    {   
        
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Organisation');
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction()
    {
           
}

    function ListVms()
    {
   
   $uuid = ""; // <-- SET UP THIS FIELD TO CARRY AN ACTUAL UUID-VALUE OF ONE OF YOUR VMS!!
   
   // load all machines (works)
   machines_load();

   }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a organisation
     *
     * @param string $id
     */
    public function editAction($id)
    {


    }

    /**
     * Creates a new organisation
     */
    public function createAction()
    {


    }
    
    

    /**
     * Saves a organisation edited
     *
     */
    public function saveAction()
    {


    }

    /**
     * Deletes a organisation
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

    }


    function machines_load () {

        $config['VBOX_USERNAME']    = "Peter Smith";   # Username for authentication to the webservice
        $config['VBOX_PASSWORD']    = "abc123";         # Password    
        $config['SOAP_OPTIONS']    = array();         # Soap call options

        // create a vbox object for the call
        $vbox = new VBoxWebServiceConnector($_SESSION['CONF']['DIR_INSTALL_PATH'].'wsdl/vboxwebService.wsdl', $_SESSION['CONF']['SOAP_OPTIONS'], $_SESSION['CONF']['VBOX_USERNAME'], $_SESSION['CONF']['VBOX_PASSWORD'] );
        $vbox->call('IVirtualBox', 'getSettingsFilePath', array());
        $res = $vbox->getResult();
        $vbox->__destruct();
        $xml = file_get_contents ($res);
        $_SESSION['VBXML'] = $xml;
    }
    
    
    function machine_getstate ( $uuid ) {
        $vbox = new VBoxWebServiceConnector($_SESSION['CONF']['DIR_INSTALL_PATH'].'wsdl/vboxwebService.wsdl', $_SESSION['CONF']['SOAP_OPTIONS'], $_SESSION['CONF']['VBOX_USERNAME'], $_SESSION['CONF']['VBOX_PASSWORD'] );
        $vbox->call('IVirtualBox', 'openSession', array('machineId'=>$uuid));
        $vbox->call('IConsole', 'getState', array());
        $res = $vbox->getResult();
        $vbox->__destruct();
        return $res;
    }


}


Class VBoxWebServiceConnector {
    
    private $api         = false;
    private $module    = false;
    private $parameters   = array();
    private $_this      = "";
    private $client    = "";
    private $error      = "NO CALLS HAVE BEEN MADE TO THE API YET!";
    private $result    = false;
    
    
    public function __construct ( $wsdl="", $options=array(), $username=false, $password=false ) {
        $this->client = new SoapClient( $wsdl, $options );
        if ( ( $username !== false ) && ( $password !== false ) ) {
            $this->logon( $username, $password );
        }
    }   
    
    
    public function __destruct () {
        if ( !empty( $this->_this ) ) {
            $this->logoff();
        }
        unset( $this->api );
        unset( $this->module );
        unset( $this->parameters );
        unset( $this->error );
        unset( $this->result );
        unset( $this->_this );
        unset( $this->client );      
    }

    
    // logon
    public function logon ( $username, $password ) {
        $obj = $this->client->IWebsessionManager_logon( $username, $password );
        $this->_this = $obj->returnval;
    }   
    
    
    // logoff
    public function logoff () {
        $o = $this->client->IWebsessionManager_logoff();
        $this->_this = "";
    }   
    
    
    // set the objects target api
    public function setApi ( $apiName ) {
        $this->api = $apiName;
    }   
    
    
    // set the objects target module
    public function setModule ( $moduleName ) {
        $this->module = $moduleName;
    }

    
    // set the objects parameters array
    public function setParameters ( $parametersArray ) {
        if ( (is_array($parametersArray)) && (!empty ($parametersArray)) ) {
            foreach ($parametersArray as $attribute => $value) {
                $this->$attribute = $value;
            }
        }
        $this->parameters = $parametersArray;        
    }
    
    
    // execute the api call with the current data of the object
    public function exec () {
        $fname = $this->api.'_'.$this->module;
        if ( is_callable( array ( $this->client, $fname ) ) ) {
            $obj = $this->client->$fname( $this ); // yes, we submit the complete object to the soap-call
            $this->result = $obj->returnval;
            $this->error = false;
        }
        else {
            $this->result = false;
            $this->error = "NO SUCH API-FUNCTION: ".$callable_name;
        }
        
    }
    
    
    // method to call api function directly
    public function call ( $apiName, $moduleName, $parametersArray=array() ) {
        $this->setApi( $apiName );
        $this->setModule( $moduleName );
        $this->setParameters( $parametersArray );
        $this->exec();         
    }
    
    
    // method to get the result of the last operation
    public function getResult () {
        if ( $this->result === false ) {
            return $this->error;
        }
        else {
            return $this->result;
        }
    }
    
    
}   //--> END CLASS
