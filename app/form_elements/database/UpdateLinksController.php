<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class UpdateLinksController extends FormElementBase
{
    
    public function Render()
    {
        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label class="form-label">Update Links</label>
<select id="update-links" name="parameters[update_links][]" style="width:100%" multiple class="form-control tableColumnMultiple" data-placeholder="Choose one or various columns...">
                                        </select>
                         </div>';

        $output['js'][]=  '

        $.getJSON("/links/getList", function (data) {

            $("#update-links").select2();

temp_html="";

for (var key in data) {
 temp_html =temp_html+"<option value=\""+data[key][\'id\']+"\">"+data[key][\'text\']+"</option>"
}

            $("#update-links").html(temp_html);

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
