<?php
namespace PRIME\Themes\Make\Widgets\Morris;
use PRIME\Themes\WidgetBase as WidgetBase;

class DonutChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/link_select"},{"type":"parameters/color_select","name":"colors","label":"Color Scheme:"},{"type":"database/single_select","name":"label","label":"Label"}]';
        $this->data_format='ByRow';


    }
}