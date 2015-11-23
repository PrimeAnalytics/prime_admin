<?php
namespace PRIME\Themes\Santone\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class ImageListController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"database/single_select","name":"image","label":"Image"},{"type":"database/single_select","name":"comment","label":"Comment"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}