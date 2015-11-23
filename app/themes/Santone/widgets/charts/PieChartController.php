<?php
namespace PRIME\Themes\Santone\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class PieChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}