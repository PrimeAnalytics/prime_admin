<?php
namespace PRIME\Widgets\Webarch\Tables;
use PRIME\Widgets\WidgetBase as WidgetBase;

class NavigationTableController extends WidgetBase
{    
    public function initialize()
    {
        $this->icon ="fa-table";
        
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" }
        ],
        "db":
        {"table1":
        [
        {"type":"multiple", "label":"Columns", "name":"columns"},
        {"type":"dashboard_link"}
        ]
        }
        }';
    }
    
}
