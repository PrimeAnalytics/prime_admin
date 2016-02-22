<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class InputController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/input","name":"title","label":"Title"}]';
        $this->data_format='ByRow';


    }
}