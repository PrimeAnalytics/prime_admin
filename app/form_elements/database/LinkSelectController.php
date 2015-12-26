<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class LinkSelectController extends FormElementBase
{
    
    public function Render()
    {
        $output=array();

        $output['html'][]='<div class="form-group">
                                    <label class="form-label">Target Link</label>
<textarea id="target-link" name="parameters[target_link]" class="form-control" style="width:100%"></textarea>
                         </div>';

        $output['js'][]=  '

        var columnData = "[]";

            var request = $.ajax({
                url: "/get/autocomplete/columns/",
                type: "get",
                success: function (result) {

                    data_temp=$("#target-link").val();

                    $("#target-link").tagEditor({
                        delimiter: \',\',
                        forceLowercase:false,
                        placeholder: \'Add Parameters ...\',
                        maxLength:500,
                        autocomplete: { source: JSON.parse(result,true), minLength: 1, delay: 0, html: true, position: { collision: \'flip\' } }
                    });
                
                },
                error:function (result) {

                }
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
