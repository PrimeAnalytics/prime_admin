<?php
namespace PRIME\FormElement\Database;
use PRIME\FormElement\FormElementBase as FormElementBase;

class LinkSelectController extends FormElementBase
{
    
    public function Render($table_id)
    {
        $output=array();

        $output['html'][]='<div class="form-group">
                                    <label class="form-label">Linking Column</label>
                                                <input id="widget-link-column" name="parameters[db][link_column]" style="width:100%">
                                                </input>
                         </div>';
        $output['html'][]='<div class="form-group">
                                    <label class="form-label">Target Link</label>
                                                <input id="target-link" name="parameters[target_link]" style="width:100%">
                                                </input>
                         </div>';

        $output['js'][]=  '$.getJSON("/dashboard/getLinks", function(data){
                                                        $("#target-link").select2({
                                                        placeholder: "Select a Link",
                                                        data:data
                                                        })
                                                        });';

        $output['js'][]='$(\'#'.$table_id.'\').on(\'change\', function() {

                var table = $(\'#'.$table_id.'\').select2(\'val\');

                $.getJSON("/get/DBColumns/" + table, function (data) {

                    $("#widget-link-column").select2({
                        data: data
                    });

                });

               })';


        return $output;
    }
}
