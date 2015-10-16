<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class DashboardSelectController extends FormElementBase
{
    
    public function Render()
    {
        $output=array();

        $output['html'][]='<div class="form-group">
                                   <label class="form-label">Target Dashboard</label>
                                                        <input id="dashboardList" style="width:100%" name="parameters[target_dashboard]">
                                                        </input>
                         </div>
                        <div class="form-group db-item">
                                    <label class="form-label">Linking Column</label>
                                                <input id="widget-link-column" name="parameters[db][link_column]" style="width:100%">
                                                </input>
                         </div>
                         <div class="form-group">
                                    <label class="form-label">Target Link</label>
                                                <input id="target-link" name="parameters[target_link]" style="width:100%">
                                                </input>
                         </div>
';



        $output['js'][]=  '$.getJSON("/dashboard/getDashboards", function(data){
                                                        $("#dashboardList").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });';



        $output['js'][]=  '$.getJSON("/links/getList", function(data){
                                                        $("#target-link").select2({
                                                        placeholder: "Select a Link",
                                                        data:data
                                                        })
                                                        });';

        $output['js'][]='$(\'#dbTable\').on(\'change\', function() {

                var table = $(\'#dbTable\').select2(\'val\');

                $.getJSON("/get/DBColumns/" + table, function (data) {

                    $("#widget-link-column").select2({
                        data: data
                    });

                });

               })';


        return $output;
    }


    public function getFormAction()
    {
        $data=array();
        echo json_encode($data);
    }
}
