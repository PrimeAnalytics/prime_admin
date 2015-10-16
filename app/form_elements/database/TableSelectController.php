<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class TableSelectController extends FormElementBase
{
    
    public function Render()
    {

        $output=array();

        $output['html'][]='<div class="form-group">
                                    <label>Select Database Table</label>
                                        <input id="dbTable" name="parameters[db][table]" class="form-control" data-placeholder="Choose a table...">
                                        </input>
                                </div>';

        $output['js'][]= '
$(\'.db-item\').hide();

        $.getJSON("/get/DBTables", function (data) {
            $("#dbTable").select2({
                data: data
            });
       
        });

$(\'#dbTable\').on(\'change\', function() {

 $(\'.db-item\').show();

});


';

        return $output;

    }

    public function getFormAction()
    {
        $data="";
        echo json_encode($data);
    }
}
