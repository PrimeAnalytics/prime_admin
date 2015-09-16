<?php
namespace PRIME\DataConnectors\Panoramio;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;
use PRIME\Models\DataConnector;
include "/../vendor/mashape/unirest-php/src/Unirest.php";

class PhotoController extends ConnectorBase
{
    
    public function initialize()
    {
        $this->icon ="fa-google";
        $this->form_struct ='{"query":
        [
        {"name":"set","label":"Set","type":"input" },
        {"name":"size","label":"Size","type":"input" },
        {"name":"minx","label":"Min X","type":"input" },
        {"name":"miny","label":"Min Y","type":"input" },
        {"name":"maxx","label":"Max X","type":"input" },
        {"name":"maxy","label":"Max Y","type":"input" },

        ]
        }';

        $this->authenticator='None';
        $this->url='http://www.panoramio.com/map/get_panoramas.php?';
        $this->method='GET';
     }


}
