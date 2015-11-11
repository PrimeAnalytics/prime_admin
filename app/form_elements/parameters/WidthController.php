<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class WidthController extends FormElementBase
{
    
    public function Render()
    {
        $values=array();
        $values[]=array('id'=>'col-md-1' ,'text'=>'8.3%' );
        $values[]=array('id'=>'col-md-2' ,'text'=>'16.7%' );
        $values[]=array('id'=>'col-md-3' ,'text'=>'25%' );
        $values[]=array('id'=>'col-md-4' ,'text'=>'33.3%' );
        $values[]=array('id'=>'col-md-5' ,'text'=>'41.7%' );
        $values[]=array('id'=>'col-md-6' ,'text'=>'50%' );
        $values[]=array('id'=>'col-md-7' ,'text'=>'58.3%' );
        $values[]=array('id'=>'col-md-8' ,'text'=>'66.7%' );
        $values[]=array('id'=>'col-md-9' ,'text'=>'75%' );
        $values[]=array('id'=>'col-md-10' ,'text'=>'83.3%' );
        $values[]=array('id'=>'col-md-11' ,'text'=>'91.7%' );
        $values[]=array('id'=>'col-md-12' ,'text'=>'100%' );
 
        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label>Width</label>
                                        <input id="width" name="parameters[width]" class="form-control" data-placeholder="Choose width...">
                                        </input>
                                </div>';




        $output['js'][]= 'var data = '.json_encode($values).';

            $("#width").select2({
              data: data
            });';

        return $output;

    }

    public function getFormAction()
    {
        echo json_encode($data);
    }
}
