<?php
namespace PRIME\Widgets\Webarch\HighCharts;
use PRIME\Widgets\WidgetBase as WidgetBase;

class LineChartController extends WidgetBase
{ 
    public function initialize()
    {
        $this->icon ="fa-line-chart";
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" },
        {"name":"subtitle","label":"Sub-title","type":"input" },
        {"name":"y_label","label":"Y-Label","type":"input" },
        {"name":"x_label","label":"X-Label","type":"input" },  
        {"name":"x_type","label":"X-Type","type":"select", "values":[{"id":"date", "value":"Date Time"},
        {"id":"number", "value":"Number"},
        {"id":"category", "value":"Category"}] }, 
        {"name":"color_scheme","label":"Color Scheme","type":"color"}
        
        ],
        "db":
        {"hc_table1":
        [
        {"type":"single", "label":"X-Axis", "name":"x_axis"},
        {"type":"multiple", "label":"Y-Series", "name":"y_series"}
        ]
        }
        }';
    }
    
 
}
