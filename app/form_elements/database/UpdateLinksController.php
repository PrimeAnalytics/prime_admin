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
                                                <input id="update-links" name="parameters[update_links][]" style="width:100%">
                                                </input>
                         </div>';

        $output['js'][]=  '$.getJSON("/links/getList", function(data){
                                                        $("#update-links").select2({
                                                        multiple:true,
                                                        placeholder: "Select Links...",
                                                        data:data
                                                        })
                                                        });';


        return $output;
    }
    public function getFormAction()
    {
        $data="";
        echo json_encode($data);
    }
}
