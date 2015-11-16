<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class SelectController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"values","label":"Values"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}