<?php
namespace PRIME\Widgets\Webarch\HighStock;
use PRIME\Widgets\WidgetBase as WidgetBase;

class BarChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->icon ="fa-area-chart";
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" }
        ], "link":{}}';
    }
    
    /**
     * Displays the creation form
     */
   

}
