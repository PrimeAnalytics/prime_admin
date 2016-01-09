<?php
namespace PRIME\Themes\Make\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class BarChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"x_label","label":"X Label"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"database/chart"},{"type":"database/link_select"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"}]';
        $this->data_format='Chart';


    }
}