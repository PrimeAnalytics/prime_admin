<?php
namespace PRIME\Themes\Pages\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class PieChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/link_select"},{"type":"parameters/color_select","name":"colors","label":"Colors"}]';
        $this->data_format='ByRow';


    }
}