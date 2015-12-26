<?php
namespace PRIME\Themes\Make\Widgets\Misc;
use PRIME\Themes\WidgetBase as WidgetBase;

class ProgressListController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"database/single_select","name":"value","label":"Values"},{"type":"database/link_select"},{"type":"database/single_select","name":"label","label":"Labels"},{"type":"parameters/select","name":"height","label":"Height","values":"300px,400px,500px,600px,700px,800px,900px,1000px"}]';
        $this->data_format='ByRow';


    }
}