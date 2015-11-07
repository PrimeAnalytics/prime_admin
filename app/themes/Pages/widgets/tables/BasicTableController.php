<?php
namespace PRIME\Themes\Pages\Widgets\Tables;
use PRIME\Themes\WidgetBase as WidgetBase;

class BasicTableController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/multi_select","name":"series","label":"Table Columns"},{"type":"parameters/input","name":"width","label":"Width"},{"type":"database/link_select"}]';
        $this->data_format='ByRow';


    }
}