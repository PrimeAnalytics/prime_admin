<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class InputController extends FormElementBase
{
    
    public function Render($name,$label)
    {
        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label>'.$label.'</label>
                                        <input id="'.$name.'" name="parameters['.$name.']" class="form-control" data-placeholder="Choose one or various columns...">
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
