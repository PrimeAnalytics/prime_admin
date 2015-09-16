<?php
namespace PRIME\Widgets\Webarch\HighCharts;
use PRIME\Widgets\WidgetBase as WidgetBase;

class SemiCircleDonutController extends WidgetBase
{
    
    public function initialize()
    {
        $this->icon ="fa-area-chart";
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" },
        {"name":"subtitle","label":"Sub-title","type":"input" }, 
         {"name":"color_scheme","label":"Color Scheme","type":"color"}
        ],
        "db":
        {"hc_table1":
        [
        {"type":"single", "label":"Labels", "name":"labels"},
        {"type":"single", "label":"Values", "name":"values"}
        ]
        }
        }';
    }
    
    /**
     * Displays the creation form
     */
   

}
