<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class FormInputController extends FormElementBase
{
    
    public function Render($name,$label)
    {
        $output=array();
        

        $output['html'][]='<div class="form-group">
                                    <label>Process List</label>
                                        <input id="processList" name="parameters[process_id]" class="form-control" data-placeholder="Choose one or various columns...">
                                        </input>
                                </div>
<div id="parametersBody">
</div>';


        $output['js'][]=  '$.getJSON("/ProcessScheduled/getProcessesScheduled", function(data){
                                                        $("#processList").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });';

        $output['js'][]= '
$("#processList").on("change", function(){
var id =$(this).val();

alert(id);

$("#parametersBody").html("");

$.getJSON("/ProcessScheduled/GetProcessInputColumns/"+id, function(data){

$.each(data, function(index, key ) {

$("#parametersBody").append("<div class=\"form-group\"><label>"+key+"</label><input  name=\"parameters[process_parms]["+ key +"]\" class=\"widget-id-select form-control\" data-placeholder=\"Choose Widget\"></input></div>");

}); 


$.getJSON("/dashboard/GetWidgetsList/38", function(data){
                                                        $(".widget-id-select").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });


                                                        
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
