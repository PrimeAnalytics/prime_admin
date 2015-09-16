<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class IframeController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-tachometer";
        
        $this->form_struct ='{"parm":
        [
        {"name":"link","label":"URL","type":"input" },
        {"name":"width","label":"Width","type":"input" },
        {"name":"height","label":"Height","type":"input" }
        ]
        }';
    }

}
