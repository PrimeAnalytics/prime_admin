<?php
namespace PRIME\DataConnectors\Google;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;
use PRIME\Models\DataConnector;
include "/../vendor/mashape/unirest-php/src/Unirest.php";

class DriveFileController extends ConnectorBase
{
    
    public function initialize()
    {
        $this->icon ="fa-google";
        $this->form_struct ='{"rest":[{"name":"file_id","type":"input","label":"File ID" }],"query":
        [{"name":"alt","type":"hidden","value":"media" }],"parms":[] "auth":[{"name":"scope","type":"hidden","value":"https://www.googleapis.com/auth/drive" }]
        }';

        $this->authenticator='Google';
        $this->url='https://www.googleapis.com/drive/v2/files';
        $this->method='GET';
     }

    public function updateAction($data_connector_id,$file_id)
    {

        $processing=array(array("name" => "Date", "type" => "date", "format" => "Ymd"),'Flight ID','Flight Name', array("name" => "Delivered", "type" => "integer"),array("name" => "Clicks", "type" => "integer"),array("name" => "CTR%", "type" => "double"));

      $excel_sheets=$this->excelArray($this->getResultsOverrideAction($data_connector_id,null,null,'{"rest":{"file_id":"'.$file_id.'"}}'));

      $results = $this->processArrayCollection($excel_sheets, json_encode($processing));

      return $results;
    }

}
