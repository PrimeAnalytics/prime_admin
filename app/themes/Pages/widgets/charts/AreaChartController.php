<?php
namespace PRIME\Themes\Pages\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class AreaChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"x_axis","label":"X-Axis"}]';
    }
}