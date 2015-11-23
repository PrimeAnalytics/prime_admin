<?php
namespace PRIME\Themes\Santone\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class LineChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"database/chart"},{"type":"parameters/input","name":"x_label","label":"X Label"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"},{"type":"database/link_select"}]';
        $this->data_format='Chart';


    }
}