<?php
namespace PRIME\FormElements\Database;
use PRIME\FormElements\FormElementBase as FormElementBase;

class ChartController extends FormElementBase
{
    
    public function Render()
    {
        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label>Chart Title</label>
                                        <input name="parameters[chart_title]" class="form-control">
                                        </input>
                                </div>';
    

        $output['html'][]= '<div class="form-group db-item">
                                    <label>X-Axis</label>
                                        <input id="x_axis" name="parameters[db][x_axis]" class="form-control" data-placeholder="Choose one X-Axis...">
                                        </input>
                                </div>
                                <div class="form-group db-item">
                                    <label>Y-Series</label>
                                        <input id="y_series" name="parameters[db][series][]" multiple class="form-control tableColumnMultiple" data-placeholder="Choose one or various columns...">
                                        </input>
                                </div>';

        $output['js'][]= '$(\'#dbTable\').on(\'change\', function() {

        var table = $(\'#dbTable\').select2(\'val\');

        $.getJSON("/process/getHeaders/" + table, function (data) {

            $("#y_series").select2({
                multiple: true,
                data: data
            });

            $("#x_axis").select2({
                data: data
            });

        });

       });';

        return $output;

    }
    public function getFormAction()
    {
        $data="";
        echo json_encode($data);
    }
}
