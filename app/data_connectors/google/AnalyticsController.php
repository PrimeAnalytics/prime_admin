<?php
namespace PRIME\DataConnectors\Google;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;
use PRIME\Models\DataConnector;
include "/../vendor/mashape/unirest-php/src/Unirest.php";

class AnalyticsController extends ConnectorBase
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
        ], "auth":[{"name":"scope","type":"hidden","value":"https://www.googleapis.com/auth/analytics.readonly" }]
        }';

        $this->authenticator='Google';
        $this->url='https://www.googleapis.com/analytics/v3/data/ga';
        $this->method='GET';
     }


}
