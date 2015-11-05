<?php
namespace PRIME\Themes\Pages\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class LiveTileController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/multi_select","name":"tiles","label":"Tiles Source"}]';
        $this->data_format='ByRow';
        $this->container='<div id="widget_{{widget.id}}" class="col-sm-3 m-b-10" ></div>';


    }
}