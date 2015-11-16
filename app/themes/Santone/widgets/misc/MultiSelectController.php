<?php
namespace PRIME\Themes\Santone\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class MultiSelectController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/select","name":"width","label":"Width","values":"1,2,3,4,5,6,7,8,9,10,11,12"},{"type":"database/single_select","name":"values","label":"Values"},{"type":"database/link_select"},{"type":"parameters/input","name":"title","label":"Title"}]';
        $this->data_format='ByRow';


    }
}