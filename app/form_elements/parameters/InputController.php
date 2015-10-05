<?php
namespace PRIME\FormElement\Parameters;
use PRIME\FormElement\FormElementBase as FormElementBase;

class InputController extends FormElementBase
{
    
    public function Render($label,$name)
    {
        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label>'.$label.'</label>
                                        <input id="'.$name.'" name="parameters['.$name.']" class="form-control" data-placeholder="Choose one or various columns...">
                                        </input>
                                </div>';

        return $output;

    }
}
