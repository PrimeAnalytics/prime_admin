<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class SelectController extends FormElementBase
{
    
    public function Render($name,$label,$values)
    {
        $values=explode(",",$values);

        $data=array();

        foreach($values as $value)
        {
        $temp=array();
        $temp['id']=$value;
        $temp['text']=$value;

        $data[]=$temp;

        }

        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label>'.$label.'</label>
                                        <input id="'.$name.'" name="parameters['.$name.']" class="form-control" data-placeholder="Choose one or various columns...">
                                        </input>
                                </div>';




       $output['js'][]= 'var data = '.json_encode($data).';

            $("#'.$name.'").select2({
              data: data
            });';

        return $output;

    }

    public function getFormAction()
    {
        $data['name']="";
        $data['label']="";
        $data['values']="";

        echo json_encode($data);
    }
}
