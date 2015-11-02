<?php
namespace PRIME\Themes\Pages\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class DateRangeController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[]';
        $this->data_format='ByRow';
        $this->container='<div id="widget_{{widget.id}}"></div>';


    }
}