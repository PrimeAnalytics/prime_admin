<?php
namespace PRIME\Controllers;
use PRIME\Models\Widget;

class WidgetController extends ControllerBase
{
    protected function initialize()
    {
        \Phalcon\Tag::prependTitle('PRIME | ');
        $this->view->setViewsDir('../app/views/');
        $this->view->setLayoutsDir('/layouts/');
    }
    
    public function moveAction($canvas_id, $row_number, $column_number, $id)
    {           
        
        $this->tag->setDefault('id', $id);
        $this->tag->setDefault('column', $column_number);
        $this->tag->setDefault('row', $row_number);
        $this->tag->setDefault('canvas_id', $canvas_id);
        
        echo $this->tag->hiddenField("id");      
        echo $this->tag->hiddenField("column");
        echo $this->tag->hiddenField("row");
        echo $this->tag->hiddenField("canvas_id");
        
    } 
    

    
    public function getDBTablesAction()
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $dbTables = $db->prepare("SHOW TABLES");
        $dbTables->execute();
        
        $json = array();
        
        while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
        {		
            foreach($row as $key=>$value) {
                
                $json[] = array(
                    'id'=> $value,
              'text' => $value
            );
            }
        }                        
        
        echo json_encode($json);
    }
    
    
        public function getAllTablesAction()
    {
            
            
        $this->view->disable();
        $db = $this->getUserDB();
        $dbTables = $db->prepare("SELECT TABLE_SCHEMA, TABLE_NAME , COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS Where TABLE_SCHEMA= database()");
        $dbTables->execute();
        
        
        $json = array();
        
        while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
        {		       
            $json[$row['TABLE_NAME']]['text']=$row['TABLE_NAME'];
            $json[$row['TABLE_NAME']]['children'][] = array(
                
                'id'=> '{"table" : "'.$row["TABLE_NAME"].'" , "column" : "'.$row["COLUMN_NAME"].'"}',
          'text' => $row['COLUMN_NAME']
        );
        } 
        
        $result;
        foreach($json as $category)
        {
            $result[]=$category;
        }
        
        echo json_encode($result);
        
    }
    
        public function getDBProceduresAction()
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $dbTables = $db->prepare("SELECT ROUTINE_NAME FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_SCHEMA= database() AND ROUTINE_TYPE = 'PROCEDURE'");
        $dbTables->execute();
        
        $json = array();
        
        while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
        {		
                
                $json[] = array(
                    'id'=> $row['ROUTINE_NAME'],
              'text' => $row['ROUTINE_NAME']
            );
        }                        
        
        echo json_encode($json);
    }
   
        public function getProcedureColumnsAction($procedure)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        
        $dbTables = $db->prepare("SELECT count(*) AS Count FROM information_schema.parameters WHERE SPECIFIC_NAME = '".$procedure."' AND SPECIFIC_SCHEMA= database()");
        $dbTables->execute();
        $count = $dbTables->fetch(\PDO::FETCH_ASSOC);
        
        if($count['Count']>0)
        {
            $a = array_fill(0, $count['Count'], '""');
        }
        else
        {
            $a=array();
        }
         
        $dbTables = $db->prepare("CALL ".$procedure."( ".implode ("," , $a )." )");
        $dbTables->execute();
                
        $json = array();
        
        $row = $dbTables->fetch(\PDO::FETCH_ASSOC);
        
        $keys= array_keys ($row);
        
        foreach($keys as $key)
        {
            $json[] = array(
                'id' => $key,
                           'text' => $key
                         );                        
       }
        echo json_encode($json);
    }
    
    
    public function getProcedureParametersAction($procedure)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        
        $dbTables = $db->prepare("SELECT PARAMETER_NAME AS NAME FROM information_schema.parameters WHERE SPECIFIC_NAME = '".$procedure."' AND SPECIFIC_SCHEMA= database()");
        $dbTables->execute();
                
        $json = array();
        
        while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
        {		
            foreach($row as $key=>$value) {
                
                $json[] = array(
                    'id'=> $value,
              'text' => $value
            );
            }
        }                        
        
        echo json_encode($json);
    }
    
    public function getDBColumnsAction($db_table)
    {
        $this->view->disable();
        $db = $this->getUserDB();
        $dbTables = $db->prepare("SHOW COLUMNS FROM `$db_table`");
        $dbTables->execute();
        
        $json = array();
        
        while($row = $dbTables->fetch(\PDO::FETCH_ASSOC))
        {		
            $json[] = array(
                'id' => $row['Field'],
                           'text' => $row['Field']
                         );
        }                        
        
        echo json_encode($json);
    }
    
    
    public function deleteAction($id)
    {
        $this->tag->setDefault('id', $id);
        echo $this->tag->hiddenField("id");  
        
    }
    
    
    public function deleteWidgetAction()
    {
        $id = $this->request->getPost("id");
        $widget = Widget::findfirst('id ='.$id);
        if (!$widget->delete()) {

            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }

        }
        else
        {
            $this->flash->success("widget was deleted successfully");
        }

        return $this->dispatcher->forward(array(
     "controller" => "dashboard",
     "action"     => "edit",
     "params"     => array('id' => $widget->dashboard_id)
 ));
          
    }
    
    /**
     * Saves a widget edited
     *
     */
    public function saveAction()
    {

        $id = $this->request->getPost("id");

        $widget = Widget::findFirstByid($id);
        if($this->request->getPost("column") != NULL)
        {
            $widget->column = $this->request->getPost("column");
        }
        
        if($this->request->getPost("row") != NULL)
        {
            $widget->row = $this->request->getPost("row");
        }
        
        if($this->request->getPost("width") != NULL)
        {
            $widget->width = $this->request->getPost("width");
        }
        
        if($this->request->getPost("canvas_id") != NULL)
        {
            $widget->canvas_id = $this->request->getPost("canvas_id");
        }
        
        if($this->request->getPost("parameters") != NULL)
        {
            $widget->parameters = json_encode($this->request->getPost("parameters"));
        }
        
        
        if (!$widget->save()) {

            foreach ($widget->getMessages() as $message) {
                $this->flash->error($message);
            }

        }
        else{
            $this->flash->success("widget was updated successfully");
        }
        
        
        return $this->dispatcher->forward(array(
    "controller" => "dashboard",
    "action"     => "edit",
    "params"     => array('id' => $widget->dashboard_id)
));
    }
    
    public static function getWidgetList()
    {
        $theme = $_SESSION["auth"]['theme'];

                $data=array();
      
              //path to directory to scan
                $directory = '../app/themes/'.$theme.'/widgets/';
                //get all files in specified directory
                $files = glob($directory . "*", GLOB_BRACE);
                //print each file name
                foreach($files as $file)
                {
                //check to see if the file is a folder/directory
                if(is_dir($file))
                {
                $subdirectory = '../app/themes/'.$theme.'/widgets/'.basename($file).'/';
                //get all files in specified directory
                $subfiles = glob($subdirectory."*.{php}", GLOB_BRACE);
                    foreach($subfiles as $subfile)
                {
                $type = str_replace("Controller.php","",basename($subfile));
                $name = trim(implode(' ', preg_split('/(?=\p{Lu})/u', $type)));
               
                $data[ucwords(basename($file))][]=$name;

                }
                }
                }

        return $data;
    }
}
