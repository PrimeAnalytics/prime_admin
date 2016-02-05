<?php
namespace PRIME\Controllers;
use PRIME\Models\Organisation;
use PRIME\Models\ProcessOperator;
use PRIME\Models\ProcessScheduled;
use PRIME\Models\OrgDatabase;
use PRIME\Models\Computer;

class StudioConnectController extends ControllerBase
{
    public $organisation_id ="";
    public $db_name="";
    protected function initialize()
    {
        $this->view->disable();      
        if ($this->session->has("auth")) {
            //Retrieve its value
            $auth = $this->session->get("auth");
            $this->organisation_id= $auth['organisation_id'];
            $this->db_name=$auth['db_name'];
        }
    }

    public function SyncProgramFilesAction()
    {
        $files = $this->get_filelist_as_array('C:\server\www\update');

        echo json_encode($files);
       
    }


   function get_filelist_as_array($dir, $recursive = true, $basedir = '') {
        if ($dir == '') {return array();} else {$results = array(); $subresults = array();}
        if (!is_dir($dir)) {$dir = dirname($dir);} // so a files path can be sent
        if ($basedir == '') {$basedir = realpath($dir).DIRECTORY_SEPARATOR;}

        $files = scandir($dir);
        foreach ($files as $key => $value){
            if ( ($value != '.') && ($value != '..') ) {
                $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
                if (is_dir($path)) { // do not combine with the next line or..
                    if ($recursive) { // ..non-recursive list will include subdirs
                        $subdirresults = $this->get_filelist_as_array($path,$recursive,$basedir);
                        $results = array_merge($results,$subdirresults);
                    }
                } else { // strip basedir and add to subarray to separate file list
                    $subresults[] = array('name'=>str_replace($basedir,'',$path),'md5'=>md5_file($path));
                }
            }
        }
        // merge the subarray to give the list of files then subdirectory files
        if (count($subresults) > 0) {$results = array_merge($subresults,$results);}
        return $results;
    }


    public function ProcessOperatorListAction()
    {

        $process_operators = ProcessOperator::findByorganisation_id($this->organisation_id);
        $temp=array();
        foreach($process_operators as $operator)
        {
            $assemblies=array();
            $files = glob('uploads/'.$operator->id.'/*.{dll,png}', GLOB_BRACE);
            foreach($files as $file) {
                $assemblies[]= array('filename'=>basename($file),'md5'=>md5_file($file));
            }
            
            
            $temp[]=array("id"=>$operator->id,"name"=>$operator->name,"category"=>$operator->category,"files"=>$assemblies, "description"=>$operator->description);
        }

        echo json_encode($temp);

    }

    public function ProcessOperatorListFullAction()
    {

        $process_operators = ProcessOperator::findByorganisation_id($this->organisation_id);

        $process_operators= $process_operators->ToArray();
        foreach($process_operators as &$operator)
        {
            
            $assemblies=array();
            $files = glob('uploads/'.$operator['id'].'/*.{dll,png}', GLOB_BRACE);
            foreach($files as $file) {
                $assemblies[]= array('filename'=>basename($file),'md5'=>md5_file($file));
            }
            $operator['files']=$assemblies;

        }

        echo json_encode($process_operators);

    }


    public function GetProcessOperatorAction($id)
    {
        
        $process_operators = ProcessOperator::findFirstById($id);

        echo json_encode($process_operators,true);

    }


    public function NewProcessOperatorAction()
    {

        $process_operators = new ProcessOperator();

        $process_operators->organisation_id=$this->organisation_id;
        $process_operators->name = $this->request->getPost("name");
        $process_operators->description= $this->request->getPost("description");
        $process_operators->category= $this->request->getPost("category");
        $process_operators->form= $this->request->getPost("form");
        $process_operators->script= $this->request->getPost("script");
        $process_operators->assemblies= $this->request->getPost("assemblies");
        $process_operators->secondary_script= $this->request->getPost("secondary_script");
        $process_operators->accessibility= $this->request->getPost("accessibility");
        $process_operators->icon= $this->request->getPost("icon");

        $responce = array();

        if($process_operators->save())
        {
            $responce['title']= "Success";
        $responce['message']= "The Operator Was Succesfully Uploaded";
        $responce['id']=$process_operators->id;

        }
        else
        {
            $responce['title']= "Error";
            $responce['message']= "Oh No, Something Whent Wrong";
            $responce['id']="";
        }

        echo json_encode($responce);

    }

    

    public function GetComputerSetupAction($key)
    {
        $computer = Computer::findFirstByKey($key);
        echo $computer->data;
    }

    public function GetComputerListAction()
    {
        $computers  = Computer::findByorganisation_id($this->organisation_id);

        echo json_encode($computers->toArray());
        
    }

    public function SaveComputerSetupAction($key)
    {
        $computer = Computer::findFirstByKey($key);
        $computer->data= $this->request->getPost("data");

        $responce = array();

        if($computer->save())
        {
            $responce['title']= "Success";
            $responce['message']= "The Computer Config Was Succesfully Saved";

        }
        else
        {
            $responce['title']= "Error";
            $responce['message']= "Oh No, Something Whent Wrong";

        }

        echo json_encode($responce);
    }


    public function uploadAssemblyAction($id)
    {

        $target_dir = "uploads/".$id."/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
            
        }

        foreach($_FILES as $file)
        {
            $target_file = $target_dir . basename($file["name"]);

            if(file_exists($target_file)) {
                chmod($target_file,0755); 
                unlink($target_file);
            }

            move_uploaded_file($file["tmp_name"], $target_file);
            echo $target_file."/r/n";
        }
        
    
    }


    public function uploadIconAction($id)
    {

        $target_dir = "uploads/".$id."/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
            
        }

        foreach($_FILES as $file)
        {
            $target_file = $target_dir . "icon.png";

            if(file_exists($target_file)) {
                chmod($target_file,0755); 
                unlink($target_file);
            }

           $image_temp= $this->resize_image($file["tmp_name"],48,48,false);
           

           $responce = array();

           if(imagepng($image_temp, $target_file, 1))
           {
               $responce['title']= "Success";
               $responce['message']= "The Image Was Successfully Uploaded";

           }
           else
           {
               $responce['title']= "Error";
               $responce['message']= "Oh No, Something Whent Wrong";

           }

           echo json_encode($responce);
        }




        }



    function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = \getimagesize($file);

        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }

        $what = getimagesize($file);

        switch(strtolower($what['mime']))
        {
            case 'image/png':
                $src = \imagecreatefrompng($file);
                break;
            case 'image/jpeg':
                $src = \imagecreatefromjpeg($file);
                break;
            case 'image/gif':
                $src = \imagecreatefromgif($file);
                break;
            default: die('image type not supported');
        }


        $newImg = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($newImg, false);
        imagesavealpha($newImg,true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $newwidth, $newheight, $transparent);
        imagecopyresampled($newImg, $src, 0, 0, 0, 0, $newwidth, $newheight,
                             $width, $height);


        return $newImg;
    }


    public function SaveProcessOperatorAction($id)
    {

        $process_operators = ProcessOperator::findFirstById($id);

        $process_operators->name = $this->request->getPost("name");
        $process_operators->description= $this->request->getPost("description");
        $process_operators->category= $this->request->getPost("category");
        $process_operators->form= $this->request->getPost("form");
        $process_operators->script= $this->request->getPost("script");
        $process_operators->assemblies= $this->request->getPost("assemblies");
        $process_operators->secondary_script= $this->request->getPost("secondary_script");
        $process_operators->accessibility= $this->request->getPost("accessibility");
        $process_operators->icon= $this->request->getPost("icon");

        $responce = array();

        if($process_operators->save())
        {
            $responce['title']= "Success";
            $responce['message']= "The Operator Was Succesfully Saved";

        }
        else
        {
            $responce['title']= "Error";
            $responce['message']= "Oh No, Something Whent Wrong";

        }

        echo json_encode($responce);

    }

    public function DeleteProcessOperatorAction($id)
    {

        $process_operators = ProcessOperator::findFirstById($id);

        $responce = array();
        if($process_operators->delete())
        {
            $responce['title']= "Success";
            $responce['message']= "The Operator Was Succesfully Deleted";
        }
        else
        {
            $responce['title']= "Error";
            $responce['message']= "Oh No, Something Whent Wrong";
        }
        echo json_encode($responce);
    }

    public function getUserDB()
    {
        try{
            $db= new \Crate\PDO\PDO('crate:localhost:4200',null, null, []);    
        }
        catch(PDOException $ex){
            
            die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
        }
        
        return $db;
    }

    public function UploadDataAction($table,$queryType="update")
    {
        ini_set('max_execution_time', 3600);
        $this->view->disable();

        $data=json_decode($this->request->getPost('data'),true);

        $this->writeDatabase($table,$data,$queryType);
        
    }


    public function ProcessScheduledListAction()
    {
        $scheduled_processes = ProcessScheduled::findByorganisation_id($this->organisation_id);
        $temp=array();
        foreach($scheduled_processes as $scheduled_process)
        {
            $temp[]=array("id"=>$scheduled_process->id,"name"=>$scheduled_process->name,"description"=>$scheduled_process->description);
        }

        echo json_encode($temp);
    
    }

    public function GetProcessScheduledAction($id)
    {
        
        $scheduled_processes = ProcessScheduled::findFirstById($id);


        echo json_encode($scheduled_processes);
    }


    public function SaveProcessScheduledAction($id)
    {
        
        $scheduled_processes = ProcessScheduled::findFirstById($id);
        $scheduled_processes->storage = $this->request->getPost("storage");


        $responce = array();

        if($scheduled_processes->save())
        {
            $responce['title']= "Success";
            $responce['message']= "The Process Was Succesfully Saved";

        }
        else
        {
            $responce['title']= "Error";
            $responce['message']= "Oh No, Something Whent Wrong";

        }

        echo json_encode($responce);

  
    }

    public function DeleteProcessScheduledAction($id)
    {
        
        $scheduled_processes = ProcessScheduled::findFirstById($id);

        $responce = array();

        if($scheduled_processes->delete())
        {
            $responce['title']= "Success";
            $responce['message']= "The Process Was Succesfully Deleted";

        }
        else
        {
            $responce['title']= "Error";
            $responce['message']= "Oh No, Something Whent Wrong";

        }

        echo json_encode($responce);

        
    }


    public function writeDatabase($table,$data,$queryType="update")
    {
        $this->view->disable();
        $connection = $this->getUserDB();

        if($queryType=="override")
        {
            $sql = "DROP TABLE IF EXISTS ".$this->db_name.".".$table;

            $connection->query($sql);
        }

       $sql = "CREATE TABLE IF NOT EXISTS ".$this->db_name.".".$table." (";

       $columnTypes=array();

       $num_rows=count($data);

       $type_set=false;

       foreach($data[0] as $key=>$column_name)
       {
           $type=gettype($data[$i][$key]);
           if($type!='string')
           {
               $type_set=true;
           }
       }

       if(!$type_set)
       {
           for($i=0;$i<$num_rows;$i++)
           {
               foreach($data[$i] as $key=>$column_name)
               {
                   $type=gettype($data[$i][$key]);

                   if('string'==gettype($data[$i][$key]))
                   {
                       if(is_numeric ($data[$i][$key]))
                       {
                           if ((int) $data[$i][$key] == (double)$data['0'][$key]) 
                           {
                               $type="integer";
                           }
                           else
                           {
                               $type="double";
                           }
                       }
                       else if(strtotime($data[$i][$key])!=false)
                       {
                           $type="date";

                       }
                       else
                       { 
                       }
                   }

                   $columnTypes[$key][$type]=true;

               }
           }

           foreach($columnTypes as $key=>$value)
           {
               if (array_key_exists("string",$value))
               {
                   $columnTypes[$key]="string";
               }
               elseif (array_key_exists("double",$value))
               {
                   $columnTypes[$key]="double";
               }
               elseif (array_key_exists("integer",$value))
               {
                   $columnTypes[$key]="integer";
               }
               elseif (array_key_exists("date",$value))
               {
                   $columnTypes[$key]="date";
               }

           }
       }
       else
       {
           foreach($data[0] as $key=>$column_name)
           {
               $type=gettype($data[0][$key]);
               $columnTypes[$key]=$type;
           }
       
       }

      



           
           foreach($columnTypes as $key=>$type)
           {
            if($type=="integer")
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" int, ";
            }
            elseif($type=="double")
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" double, "; 
            }
            elseif($type=="date")
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" timestamp, "; 
            }
            else
            {
                $sql=$sql."\"".strtolower(str_replace(" ", "_", $key))."\" string, ";  
            }
        }

        $sql=substr($sql, 0, -2);

        
          $sql=$sql.")";                
        

        $connection->query($sql);
        
        
        $rows=array();



        $headings=array();

        foreach(array_keys ($data['0']) as $key)
        {
          $headings[]=strtolower(str_replace(" ", "_", $key));
        }

        $sql = "INSERT INTO ".$this->db_name.".".$table." (\"".implode ("\",\"" , $headings)."\") VALUES ";
        foreach($data as $row)
        {
            if(count($data['0'])==count($row))
            {
                $temp="";
                foreach($row as $key=>$value)
                {
                    

                    if($columnTypes[$key]=="integer")
                    {
                        if ($value=="")
                        {
                            $value=0;
                        }
                        $temp.= $value." , ";
                    }
                    elseif($columnTypes[$key]=="double")
                    {
                        if ($value=="")
                        {
                            $value=0;
                        }
                        $temp.= $value." , ";
                    }
                    elseif($columnTypes[$key]=="date")
                    {
                        if ($value=="")
                        {
                            $value=0;
                        }
                        $temp.= "".(strtotime($value)*1000)." , ";
                    }
                    else
                    {
                        if ($value=="")
                        {
                            $temp.= "NULL , ";

                        }
                        else
                        {
                            $temp.= "'".addslashes ($value)."' , ";
                        }
                    }
 
                }
                $temp=substr($temp, 0, -2);
                $rows[]="(".$temp.")";
            }
        }

         $sql=$sql.implode (", " , $rows)." ON DUPLICATE KEY UPDATE ";

        $duplicate_values=array();

        foreach($data['0'] as $column_name=>$values)
        {
            $duplicate_values[]="\"".strtolower(str_replace(" ", "_", $column_name))."\" =VALUES(\"".strtolower(str_replace(" ", "_", $column_name))."\")";        
        }

       $sql=$sql.implode (" ," , $duplicate_values)."";


        if($error=$connection->query($sql))
        {
         
            echo "success";
         
        }
        else
        {
            $errors = $connection->errorInfo();
            print_r($errors[2]);
            return $data_out=null;
        }




    }
    
}
