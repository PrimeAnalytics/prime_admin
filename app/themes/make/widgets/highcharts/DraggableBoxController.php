<?php
namespace PRIME\Widgets\Webarch\HighCharts;
use PRIME\Widgets\WidgetBase as WidgetBase;

class DraggableBoxController extends WidgetBase
{ 
    public function initialize()
    {
        $this->icon ="fa-line-chart";
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" }
        ], "link":{}}';
    }
    
 
}
