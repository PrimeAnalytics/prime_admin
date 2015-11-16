<?php
namespace PRIME\Themes\Pages\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class BarChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"database/chart"},{"type":"parameters/input","name":"x_label","label":"X Label"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"database/link_select"}]';
        $this->data_format='Chart';


    }
}