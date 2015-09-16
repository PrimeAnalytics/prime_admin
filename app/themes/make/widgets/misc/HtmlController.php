<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class HtmlController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-tachometer";
        
        $this->form_struct ='{"parm":
        [
        {"name":"html","label":"HTML","type":"input" }
        ]
        }';
    }

}
