<?php
namespace PRIME\Themes\Make\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class AreaChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/link_select"},{"type":"database/chart"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"parameters/input","name":"x_label","label":"X Label"}]';
        $this->data_format='Chart';


    }
}