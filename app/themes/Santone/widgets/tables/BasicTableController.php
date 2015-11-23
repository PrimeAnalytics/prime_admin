<?php
namespace PRIME\Themes\Santone\Widgets\Tables;
use PRIME\Themes\WidgetBase as WidgetBase;

class BasicTableController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"database/multi_select","name":"series","label":"Table Columns"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}