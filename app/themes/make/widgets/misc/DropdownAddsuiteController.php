<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class DropdownAddsuiteController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-th-list";
        
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" }
        ],
        "db":
        {"table1":
        [
        {"type":"single", "label":"Values", "name":"values"},
        {"type":"link"}
        ]
        }
        }';
    }
    

}
