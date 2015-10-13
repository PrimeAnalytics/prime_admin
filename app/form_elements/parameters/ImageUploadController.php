<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class ImageUploadController extends FormElementBase
{
    
    public function Render($label,$name)
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
}
