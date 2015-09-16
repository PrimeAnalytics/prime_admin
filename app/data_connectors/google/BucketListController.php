<?php
namespace PRIME\DataConnectors\Google;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;
use PRIME\Models\DataConnector;
include "/../vendor/mashape/unirest-php/src/Unirest.php";

class BucketListController extends ConnectorBase
{
    
    public function initialize()
    {
        $this->icon ="fa-google";
        $this->form_struct ='{"rest":[{"name":"1","type":"hidden","value":"b" },{"name":"2","label":"Bucket ID","type":"input" },{"name":"3","type":"hidden","value":"o" }], "auth":[{"name":"scope","type":"hidden","value":"https://www.googleapis.com/auth/devstorage.read_only" }]
        }';

        $this->authenticator='Google';
        $this->url='https://www.googleapis.com/storage/v1';
        $this->method='GET';
     }


    public function getObjectAction($data_connector_id,$echo=false)
    {
        $this->view->disable();
        $result = $this->getResultsAction($data_connector_id);

        $parameters_in=array();

        $url=end(json_decode($result,true)['items'])['mediaLink'];

        if ($echo==true)
        {
           echo $this->getResultsOverrideAction($data_connector_id,null,$url,json_encode($parameters_in),true);
        }
        else
        {

        return  $this->getResultsOverrideAction($data_connector_id,null,$url,json_encode($parameters_in),true);

        }
    
    }


    public function updateAction($data_connector_id)
    {
        $data = str_getcsv ( $this->getObjectAction($data_connector_id),"\n");
        foreach($data as &$row) $row = str_getcsv($row, ",",'"');

        $this->writeMysql($data_connector_id,$data,"update");
        return;
    }




}
