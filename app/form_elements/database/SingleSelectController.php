<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class SingleSelectController extends FormElementBase
{
    
    public function Render($name,$label)
    {

        $output=array();

        $output['html'][]='<div class="form-group db-item">
                                    <label>'.$label.'</label>
                                        <input id="'.$name.'" name="parameters[db]['.$name.']" class="form-control" data-placeholder="Choose a column...">
                                        </input>
                                </div>';

        $output['js'][]= '$(\'#dbTable\').on(\'change\', function() {

        var table = $(\'#dbTable\').select2(\'val\');

        $.getJSON("/process/getHeaders/" + table, function (data) {

            $("#'.$name.'").select2({
                data: data
            });

        });

       })';

        return $output;

    }

    public function getFormAction()
    {
        $data['name']="";
        $data['label']="";
        echo json_encode($data);
    }
}
