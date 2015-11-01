<?php
namespace PRIME\Themes\Pages\Widgets\Nvd3;
use PRIME\Themes\WidgetBase as WidgetBase;

class LineChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/chart"}]';
        $this->data_format='Chart';
        $this->container='<div id="widget_{{widget.id}}"></div>';


    }
}