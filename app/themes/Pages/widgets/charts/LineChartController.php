<?php
namespace PRIME\Themes\Pages\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class LineChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/chart"},{"type":"parameters/select","name":"chart_type","label":"Chart  Type","values":"area,bar,areaspline,bar,column,scatter,spline"}]';
        $this->data_format='Chart';
        $this->container='<div id="widget_{{widget.id}}"></div>';


    }
}