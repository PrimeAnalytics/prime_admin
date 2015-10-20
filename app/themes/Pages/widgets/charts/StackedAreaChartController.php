<?php
namespace PRIME\Themes\Pages\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class StackedAreaChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[]';
        $this->data_format='ByRow';
        $this->container='<div id="widget_{{widget.id}}"></div>';


    }
}