<?php
namespace PRIME\Themes\Make\Canvas;
use PRIME\Themes\CanvasBase as CanvasBase;

class DefaultController extends CanvasBase
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
