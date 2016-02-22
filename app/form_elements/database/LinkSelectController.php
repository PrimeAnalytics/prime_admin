<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class LinkSelectController extends FormElementBase
{
    
    public function Render()
    {
        $output=array();



        $output['html'][]='
<div class="">
<div class="form-group">
                                    <label>Link Type</label>
                                        <select id="linkType" name="parameters[link_type]" class="form-control" data-placeholder="Select Link Type">
                                        <option value="database">Database Column</option>
                                        <option value="variable">Variable Set</option>
                                        </select>
                                </div></div>
<div id="DatabaseLinkBody">
</div>

<div class="form-group">
                                    
<div id="target-link-body">                    
</div>
                                </div>
';

        $output['js'][]=  '


$(\'#linkType\').on(\'change\', function() {
if($(this).val()=="variable")
{

$("#DatabaseLinkBody").html("");
$("#target-link-body").html("<label>Select Variable</label> <input id=\"linkVariable\" name=\"parameters[target_link]\" class=\"form-control\" data-placeholder=\"Choose a variable...\"></input>");
$.getJSON("/Variables/getList", function (data) {
            $("#linkVariable").select2({
                data: data,
                multiple:true
            });   
        });

}
else if($(this).val()=="database")
{
$("#DatabaseLinkBody").html("<div class=\"form-group\"><label>Select Table</label><input id=\"linkTable\" name=\"parameters[link_table]\" class=\"form-control\" data-placeholder=\"Choose a table...\"></input></div>");
           
$.getJSON("/Get/DBTables", function (data) {
            $("#linkTable").select2({
                data: data
            });
       
        });

changeToDb();

$("#target-link-body").html("");

}
});




function changeToDb()
{

$(\'#linkTable\').on(\'change\', function() {


$("#target-link-body").html("<label>Select Database Column</label><textarea id=\"target-link\" name=\"parameters[target_link]\" class=\"form-control\" style=\"width:100%\"></textarea>");

var table =$("#linkTable").val();

        var columnData = "[]";

            var request = $.ajax({
                url: "/get/autocomplete/columns/"+table,
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

});
}

';


        return $output;
    }
    public function getFormAction()
    {
        $data="";
        echo json_encode($data);
    }
}
