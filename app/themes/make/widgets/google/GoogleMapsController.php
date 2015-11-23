<?php
namespace PRIME\Themes\Make\Widgets\Google;
use PRIME\Themes\WidgetBase as WidgetBase;

class GoogleMapsController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"longitude","label":"Longitude"},{"type":"database/single_select","name":"latitude","label":"Latitude"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"parameters/select","name":"height","label":"Height","values":"200px,300px,400px,500px,600px,700px,800px,900px,1000px"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}