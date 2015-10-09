<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class MultiSelectController extends FormElementBase
{
    
    public function Render($label,$name)
    {
        $output=array();

        $output['html'][]= '<div class="form-group">
                                    <label>'.$label.'</label>
                                        <input id="'.$name.'" name="parameters[db]['.$name.']" multiple class="form-control tableColumnMultiple" data-placeholder="Choose one or various columns...">
                                        </input>
                                </div>';

        $output['js'][]= '$(\'#'.$table_id.'\').on(\'change\', function() {

        var table = $(\'#'.$table_id.'\').select2(\'val\');

        $.getJSON("/get/DBColumns/" + table, function (data) {

            $("#'.$name.'").select2({
                multiple: true,
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
