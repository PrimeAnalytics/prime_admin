<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class MultiSelectController extends FormElementBase
{
    
    public function Render($name,$label)
    {
        $output=array();

        $output['html'][]= '<div class="form-group db-item">
                                    <label>'.$label.'</label>
                                        <select id="'.$name.'" name="parameters[db]['.$name.'][]" multiple class="form-control tableColumnMultiple" data-placeholder="Choose one or various columns...">
                                        </select>
                                </div>';

        $output['js'][]= '$(\'#dbTable\').on(\'change\', function() {

        var table = $(\'#dbTable\').select2(\'val\');

        $.getJSON("/process/getHeaders/" + table, function (data) {

            $("#'.$name.'").select2();

temp_html="";

for (var key in data) {
 temp_html =temp_html+"<option value=\""+data[key][\'id\']+"\">"+data[key][\'text\']+"</option>"
}

            $("#'.$name.'").html(temp_html);

        });

       });';

        return $output;

    }
    public function getFormAction()
    {
        $data['name']="";
        $data['label']="";
        echo json_encode($data);
    }
}
