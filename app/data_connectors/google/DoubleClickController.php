<?php
namespace PRIME\DataConnectors\Google;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;
use PRIME\Models\DataConnector;
include "/../vendor/mashape/unirest-php/src/Unirest.php";

class DoubleClickController extends ConnectorBase
{
    
    public function initialize()
    {
        $this->icon ="fa-google";
        $this->form_struct ='{"auth":[{"name":"scope","type":"hidden","value":"https://www.googleapis.com/auth/doubleclickbidmanager" }]
        }';

        $this->authenticator='Google';
        $this->url='https://www.googleapis.com/doubleclickbidmanager/v1/queries';
        $this->method='GET';
     }


}
