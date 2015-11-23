<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class ListMenuController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"database/single_select","name":"value","label":"Values"},{"type":"database/link_select"},{"type":"database/single_select","name":"label","label":"Labels"}]';
        $this->data_format='ByRow';


    }
}