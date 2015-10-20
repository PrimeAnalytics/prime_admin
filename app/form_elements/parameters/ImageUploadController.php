<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class ImageUploadController extends FormElementBase
{
    
    public function Render($name,$label)
    {
        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label>'.$label.'</label>
                                        <input type="file" id="'.$name.'" name="parameters['.$name.']" class="form-control" data-placeholder="Choose Image to Upload">
                                        </input>
                                </div>';


        return $output;

    }

    public function getFormAction()
    {
        $data['name']="";
        $data['label']="";
        echo json_encode($data);
    }


    public function uploadAction($id)
    {
        // You need to add server side validation and better error handling here

        $data = array();

        if(isset($_GET['files']))
        {  
            $error = false;
            $files = array();

            $uploaddir = './uploads/';
            foreach($_FILES as $file)
            {
                if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
                {
                    $files[] = $uploaddir .$file['name'];
                }
                else
                {
                    $error = true;
                }
            }
            $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
        }
        else
        {
            $data = array('success' => 'Form was submitted', 'formData' => $_POST);
        }

        echo json_encode($data);

        }


}
