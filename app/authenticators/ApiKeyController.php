<?php
namespace PRIME\Authenticators;
use \Phalcon\Mvc\Controller as Controller;
use PRIME\Models\DataConnector;

class ApiKeyController extends Controller
{
    
    public function initialize()
    {
        $this->form_struct ='{"query":[{"name":"_apikey","label":"API Key","type":"input"}]}';

    }

    public function GetTokenAction($data_connector_id)
    {
        
    }

    public function AuthenticateAction($data_connector_id)
    {
       
    }

    public function RefreshTokenAction($data_connector_id)
    {
      
    }
}