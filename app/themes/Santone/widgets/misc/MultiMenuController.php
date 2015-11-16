<?php
namespace PRIME\Themes\Santone\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class MultiMenuController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"database/single_select","name":"value","label":"Values"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}