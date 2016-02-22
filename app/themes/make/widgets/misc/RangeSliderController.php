<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class RangeSliderController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/single_select","name":"values","label":"Values"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}