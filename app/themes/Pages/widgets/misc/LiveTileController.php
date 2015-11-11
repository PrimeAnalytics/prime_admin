<?php
namespace PRIME\Themes\Pages\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class LiveTileController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"database/multi_select","name":"tiles","label":"Tiles Source"},{"type":"parameters/color_picker","name":"tile_color","label":"Tile Color"}]';
        $this->data_format='ByRow';


    }
}