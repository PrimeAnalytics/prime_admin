<?php
namespace PRIME\Themes\Pages\Widgets\Tables;
use PRIME\Themes\WidgetBase as WidgetBase;

class BasicTableController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/multi_select","name":"series","label":"Table Columns"}]';
        $this->data_format='ByRow';
        $this->container='<table id="widget_{{widget.id}}" class="table table-hover table-condensed" ></table>';


    }
}