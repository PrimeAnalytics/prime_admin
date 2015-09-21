<?php
namespace PRIME\Themes\Make\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class BarChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" },
        {"name":"color_scheme","label":"Color Scheme","type":"color"}
        ],
        "db":
        {"mc_table1":
        [
        {"type":"single", "label":"X-Axis", "name":"x_axis"},
        {"type":"multiple", "label":"Series", "name":"y_series"}
        ]
        }
        }';
    }
    
    /**
     * Displays the creation form
     */
   

}
