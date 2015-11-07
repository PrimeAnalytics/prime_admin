<?php
namespace PRIME\Themes\Pages\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class PieChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/link_select"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"parameters/select","name":"width","label":"Width","values":"1,2,3,4,5,6,7,8,9,10,11,12"},{"type":"parameters/input","name":"chart_title","label":"Title"}]';
        $this->data_format='ByRow';


    }
}