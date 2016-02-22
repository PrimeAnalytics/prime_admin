<?php
namespace PRIME\Themes\Make\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class TreemapController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"database/link_select"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"parameters/select","name":"height","label":"Height","values":"100,200,300,400,500,600,700,800,900,1000"}]';
        $this->data_format='ByRow';


    }
}