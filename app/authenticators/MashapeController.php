<?php
namespace PRIME\Authenticators;
use \Phalcon\Mvc\Controller as Controller;
use PRIME\Models\DataConnector;

class MashapeController extends Controller
{
    
    public function initialize()
    {
        $this->form_struct ='{"query":
        [
        {"name":"_apikey","label":"API Key","type":"input"}
        ]
        }';

    }

    public function GetTokenAction($data_connector_id)
    {
        echo "Does not require tokens"; 
    }

    public function AuthenticateAction($data_connector_id)
    {
        echo "Does not require tokens"; 
    }

    public function RefreshTokenAction($data_connector_id)
    {
        echo "Does not require tokens"; 
    }
}
