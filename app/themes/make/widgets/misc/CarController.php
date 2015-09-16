<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class CarController extends WidgetBase
{
    public function initialize()
    {
        $this->icon ="fa-tachometer";
        
        $this->form_struct ='{
        "db":
        {"table1":
        [
        {"type":"single", "label":"Name", "name":"name"},
        {"type":"single", "label":"Brand", "name":"brand"},
        {"type":"single", "label":"Image", "name":"image"},
        {"type":"single", "label":"Price", "name":"price"},
        {"type":"single", "label":"Class", "name":"class"},
        {"type":"single", "label":"Power", "name":"power"},
        {"type":"single", "label":"Capacity", "name":"capacity"},
        {"type":"single", "label":"Transmission", "name":"transmission"},
        {"type":"single", "label":"Cylinders", "name":"cylinders"},
        {"type":"single", "label":"Fuel", "name":"fuel"},
        {"type":"single", "label":"Price Score", "name":"price_score"},
        {"type":"single", "label":"Power Score", "name":"power_score"},
        {"type":"single", "label":"Capacity Score", "name":"capacity_score"},
        {"type":"single", "label":"Power Per Liter Score", "name":"ppl_score"},
        {"type":"single", "label":"Price Per 1000 ZAR Score", "name":"ppk_score"}
        ]
        }
        }';
    }
    

}
