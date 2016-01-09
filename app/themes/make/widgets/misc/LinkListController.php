<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class LinkListController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"database/link_select"},{"type":"database/single_select","name":"value","label":"Values"}]';
        $this->data_format='ByRow';


    }
}