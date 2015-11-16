<?php
namespace PRIME\Themes\Santone\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class GroupedChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"parameters/select","name":"xtype","label":"X Type","values":"Date,Category,Numeric"},{"type":"database/single_select","name":"x_axis","label":"X-Axis"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"parameters/input","name":"x_label","label":"X-Label"},{"type":"parameters/input","name":"y_label","label":"Y-Label"},{"type":"parameters/select","name":"chart_type","label":"Chart Type","values":"area,bar,areaspline,bar,column,scatter,spline"},{"type":"database/single_select","name":"grouping","label":"Grouping"},{"type":"database/single_select","name":"y_axis","label":"Y-Axis"}]';
        $this->data_format='ByRow';


    }
}