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
        
        $tempController = new \PRIME\FormElement\Parameters\InputController();
        $tempController->Render($parameter['label'],$parameter['name']);

        $layout=json_decode($layout);

        foreach($layout as $key=>$value)
        {

        if($key=="parameter")
        {
            foreach($value as $parameter)
            {
            switch ($parameter['type']) {
            case Input:
                $tempController = new \PRIME\FormElement\Parameters\InputController();
                $tempController->Render($parameter['label'],$parameter['name']);
                break;
            case Select:
                $tempController = new \PRIME\FormElement\Parameters\SelectController();
                $tempController->Render($parameter['label'],$parameter['name'],$parameter['values']);
                break;
            case ColorSelect:
                $tempController = new \PRIME\FormElement\Parameters\ColorSelectController();
                $tempController->Render($parameter['label'],$parameter['name']);
                break;
            }
            }
        }
        elseif($key=="db")
        {
        foreach($value as $parameter)
            {
            switch ($parameter['type']) {
            case DashboardSelect:
                $tempController = new \PRIME\FormElement\Database\DashboardSelectController();
                $tempController->Render($parameter['label'],$parameter['name'],$parameter['values']);
                break;
            case LinkSelect:
                $tempController = new \PRIME\FormElement\Database\LinkSelectController();
                $tempController->Render($parameter['label'],$parameter['name'],$parameter['values']);
                break;
            case MultiSelect:
                $tempController = new \PRIME\FormElement\Database\MultiSelectController();
                $tempController->Render($parameter['label'],$parameter['name'],$parameter['values']);
                break;
            case SingleSelect:
                $tempController = new \PRIME\FormElement\Database\SingleSelectController();
                $tempController->Render($parameter['label'],$parameter['name'],$parameter['values']);
                break;
                }
             }
           }  
        }


     
        function echo_func($data)
        {

            foreach($data as $result)
            {
                if (is_array ($result))
                {
                    
                    echo_func($result);
                    
                }
                else
                
                {
                    echo $result;
                }
                
            }
            
        }
        
        
        echo_func($echo_array);
         
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
