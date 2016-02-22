<?php
namespace PRIME\Themes\Make\Widgets\Form;
use PRIME\Themes\WidgetBase as WidgetBase;

class SubmitController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/form_input","name":"text","label":"Text"}]';
        $this->data_format='ByRow';


    }
}