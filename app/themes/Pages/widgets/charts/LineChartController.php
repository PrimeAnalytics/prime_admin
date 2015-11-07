<?php
namespace PRIME\Themes\Pages\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class LineChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/chart"},{"type":"parameters/select","name":"chart_type","label":"Chart  Type","values":"area,bar,areaspline,column,scatter,spline"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"},{"type":"parameters/select","name":"width","label":"Width","values":"1,2,3,4,5,6,7,8,9,10,11,12"},{"type":"database/link_select"}]';
        $this->data_format='Chart';


    }
}