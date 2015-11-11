<?php
namespace PRIME\Themes\Pages\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class IndicatorAreaChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"x_axis","label":"X Axis"},{"type":"database/single_select","name":"y_axis","label":"Y Axis"}]';
        $this->data_format='ByRow';


    }
}