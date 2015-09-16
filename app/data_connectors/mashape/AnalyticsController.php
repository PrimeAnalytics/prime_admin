<?php
namespace PRIME\DataConnectors\Google;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;
use PRIME\Models\DataConnector;
include "/../vendor/mashape/unirest-php/src/Unirest.php";

class SpotifyController extends ConnectorBase
{
    
    public function initialize()
    {
        $this->icon ="fa-google";
        $this->form_struct ='{"query":
        [
        {"name":"ids","label":"IDs","type":"input" },
        {"name":"start-date","label":"Start Date","type":"input" },
        {"name":"end-date","label":"End Date","type":"input" },
        {"name":"metrics","label":"Metrics","type":"input" }
        ]
        }';

        $this->authenticator='Mashape';
        $this->url='https://mager-spotify-web.p.mashape.com/lookup/1/.json';
        $this->method='GET';
     }


}
