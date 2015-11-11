<?php
namespace PRIME\Themes\Pages\Widgets\Morris;
use PRIME\Themes\WidgetBase as WidgetBase;

class DonutChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}