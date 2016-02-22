<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class GroupedScatterPlotController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"parameters/select","name":"xtype","label":"X Type","values":"Date,Category,Numeric"},{"type":"database/single_select","name":"y_axis","label":"Y-Axis"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"database/link_select"},{"type":"database/single_select","name":"x_axis","label":"X-Axis"},{"type":"database/single_select","name":"grouping","label":"Grouping"}]';
        $this->data_format='ByRow';


    }
}