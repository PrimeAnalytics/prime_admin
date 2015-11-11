<?php
namespace PRIME\Themes\Pages\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class IndicatorController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/single_select","name":"max","label":"Max"}]';
        $this->data_format='ByRow';


    }
}