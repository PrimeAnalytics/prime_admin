<?php
namespace PRIME\Controllers;

class FormController extends ControllerBase
{
    protected function initialize()
    {
        \Phalcon\Tag::prependTitle('PRIME | ');
        $this->view->setViewsDir('../app/views/');
        $this->view->setLayoutsDir('/layouts/');
    }
    
    public function renderAction($layout)
    {      
        $layout=json_decode($layout);
        $output=array();
        
        foreach($layout as $value)
        {

            $temp=explode("/" ,$value->type);
            $type=array_values($temp)[1];
            $category=array_values($temp)[0];
            

            if($category=="parameters")
        {
            
            switch ($type) {
            case 'input':
                $tempController = new \PRIME\FormElements\Parameters\InputController();
                $output[]=$tempController->Render($value->label,$value->name);
                break;
            case 'select':
                $tempController = new \PRIME\FormElements\Parameters\SelectController();
                $output[]=$tempController->Render($value->label,$value->name,$value->values);
                break;
            case 'color_select':
                $tempController = new \PRIME\FormElements\Parameters\ColorSelectController();
                $output[]=$tempController->Render($value->label,$value->name);
                break;
            }
            
        }
        elseif($category=="db")
        {
            switch ($type) {
            case 'dashboard_select':
                $tempController = new \PRIME\FormElements\Database\DashboardSelectController();
                $output[]=$tempController->Render($value['label'],$value['name'],$value['values']);
                break;
            case 'link_select':
                $tempController = new \PRIME\FormElements\Database\LinkSelectController();
                $output[]= $tempController->Render($value['label'],$value['name'],$value['values']);
                break;
            case 'multi_select':
                $tempController = new \PRIME\FormElements\Database\MultiSelectController();
                $output[]=$tempController->Render($value['label'],$value['name'],$value['values']);
                break;
            case 'single_select':
                $tempController = new \PRIME\FormElements\Database\SingleSelectController();
                $output[]=$tempController->Render($value['label'],$value['name'],$value['values']);
                break;
                }
             }
           }  
        
        $data_out['style']=array();
        $data_out['style'][]="<style>";

        $data_out['html']=array();
        $data_out['js']=array();
        $data_out['js'][]="<script>";


        foreach($output as $param)
        {
            if(array_key_exists ('style',$param))
            {
                $data_out['style']=array_merge($data_out['style'],$param['style']);
            }
            if(array_key_exists ('html',$param))
            {
                $data_out['html']=array_merge($data_out['html'],$param['html']);
            }
            if(array_key_exists ('js',$param))
            {
                $data_out['js']=array_merge($data_out['js'],$param['js']);
            }
        }

        $data_out['style'][]="</style>";
        $data_out['js'][]="</script>";

        return $this->echo_func($data_out,'');
         
    } 


    private function echo_func($data,$output)
        {

            foreach($data as $result)
            {
                if (is_array ($result))
                {
                    
                    $output= $this->echo_func($result,$output);
                    
                }
                else
                
                {
                    $output= $output.$result;
                }
                
            }

            return $output;
            
        }



    public function StyleSheets()
    {
        $output=array();
        $output[]= '<link href="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>';
        $output[]= '<link href="/assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" media="screen"/>';
        $output[]= '<link href="/assets/plugins/icon-picker/css/fontawesome-iconpicker.min.css" rel="stylesheet">';

        return implode('\r\n',$output);
    }


    public function JavaScript()
    {
        $output=array();
        $output[]= '<script src="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>';
        $output[]= '<script src="/assets/plugins/select2/js/select2.js" type="text/javascript"></script>';
        $output[]= '<script src="/assets/plugins/icon-picker/js/fontawesome-iconpicker.js"></script>';

        return implode('\r\n',$output);
    }

    public static function getFormElementList()
    {
        $data=array();
        
        //path to directory to scan
        $directory = '../app/form_elements/';
        //get all files in specified directory
        $files = glob($directory . "*", GLOB_BRACE);
        //print each file name
        foreach($files as $file)
        {
            //check to see if the file is a folder/directory
            if(is_dir($file))
            {
                $subdirectory = '../app/form_elements/'.basename($file).'/';
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
