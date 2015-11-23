<?php
namespace PRIME\Themes\Santone\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class ListboxController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"database/single_select","name":"values","label":"Values"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}