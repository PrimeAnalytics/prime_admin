<?php
namespace PRIME\DataConnectors\Importio;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;
use PRIME\Models\DataConnector;
include "/../vendor/mashape/unirest-php/src/Unirest.php";

class GoogleExcelExtractorController extends ConnectorBase
{
    
    public function initialize()
    {
        $this->icon ="fa-google";
        $this->form_struct ='{"google_parm":[{"name":"macro_url","type":"input","label":"Macro Url"},{"name":"folder","type":"input","label":"Root Folder"},{"name":"file_getter_id","type":"input","label":"File Getter ID"}]}';

        $this->authenticator='ApiKey';
        $this->url='https://api.import.io/store/data';
        $this->method='GET';
     }


    public function getObjectAction($data_connector_id,$echo=false)
    {
        $this->view->disable();
        $result = json_decode($this->getResultsAction($data_connector_id),true);

		$result['items'];
    
    }


    public function updateAction($data_connector_id)
    {
        set_time_limit ( 500 );

        $data_connector = DataConnector::findFirstByid($data_connector_id);
        $parameters=(array)json_decode($data_connector->parameters,true);


        $parm_in=array();
        $parm_in["query"]['folder']=$parameters['google_parm']["folder"];


        $folder_structure=json_decode($this->getResultsOverrideAction($data_connector_id,"GET",$parameters['google_parm']["macro_url"],json_encode($parm_in),true));

        $data=array();

        foreach($folder_structure as $l1key=>$l1value)
        {
            if (property_exists ($l1value,"type"))
            {
                
            }
            else
            {
            foreach($l1value->children as  $l2key=>$l2value)
            {
                if (property_exists ($l2value,"type"))
                {
                    $newController = new \PRIME\DataConnectors\Google\DriveFileController();
                    $newController->initialize();
                    $data[$l1key][$l2key]=($newController->updateAction(1,$l2value->id));   
                    $this->writeMysql($data_connector_id, $data[$l1key][$l2key]);
                }
            }

            }
        }

        return;
    }




}
