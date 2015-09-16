<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class SalesGraphController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-tachometer";
        
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" }
        ],
        "db":
        {"table1":
        [
        {"type":"single", "label":"Overall", "name":"overall"},
        {"type":"single", "label":"This Month", "name":"month"},
        {"type":"single", "label":"Last Month", "name":"month_last"}
        ],
        "table2":
        [
        {"type":"multiple", "label":"Columns", "name":"columns"}
        ]
        }
        }';
    }
    

}
