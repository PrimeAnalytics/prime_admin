<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class IndicatorController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-tachometer";
        
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" },
        {"name":"style","label":"Style","type":"select", "values":[{"id":"green", "value":"Green"},{"id":"red", "value":"Red"},{"id":"blue", "value":"Blue"},{"id":"purple", "value":"Purple"}]}
        ],
        "db":
        {"table1":
        [
        {"type":"single", "label":"Overall", "name":"overall"},
        {"type":"single", "label":"This Month", "name":"month"},
        {"type":"single", "label":"Last Month", "name":"month_last"},
        {"type":"link"}
        ]
        }
        }';
    }
    

}
