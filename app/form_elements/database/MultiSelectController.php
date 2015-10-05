<?php
namespace PRIME\FormElement\Database;
use PRIME\FormElement\FormElementBase as FormElementBase;

class MultiSelectController extends FormElementBase
{
    
    public function Render($label,$name,$table_id)
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
}
