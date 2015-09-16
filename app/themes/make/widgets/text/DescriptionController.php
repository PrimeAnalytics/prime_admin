<?php
namespace PRIME\Widgets\Webarch\Text;
use PRIME\Widgets\WidgetBase as WidgetBase;

class DescriptionController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-file-text";
        
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" }
        ],
        "db":
        {"mc_table1":
        [
        {"type":"single", "label":"X-Axis", "name":"x_axis"},
        {"type":"multiple", "label":"Series", "name":"y_series"},
        {"type":"link"}
        ]
        }
        }';
    }

}
