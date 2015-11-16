<?php
namespace PRIME\Themes\Santone\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class Chart2dController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"database/chart"},{"type":"parameters/select","name":"chart_type","label":"Chart  Type","values":"area,bar,areaspline,column,scatter,spline"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"database/link_select"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"}]';
        $this->data_format='Chart';


    }
}