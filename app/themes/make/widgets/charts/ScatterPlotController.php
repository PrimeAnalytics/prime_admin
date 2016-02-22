<?php
namespace PRIME\Themes\Make\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class ScatterPlotController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/input","name":"x_label","label":"X Label"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"database/link_select"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"},{"type":"database/chart"}]';
        $this->data_format='Chart';


    }
}