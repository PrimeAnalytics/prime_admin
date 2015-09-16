<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class DynamicHeadingController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-th-list";
        
        $this->form_struct ='{"db":
        {"table1":
        [
        {"type":"multiple", "label":"Values", "name":"values"}
        ]
        }
        }';
    }
    

}
