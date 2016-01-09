<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class MultiSelectController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/link_select"},{"type":"database/single_select","name":"values","label":"Values"}]';
        $this->data_format='ByRow';


    }
}