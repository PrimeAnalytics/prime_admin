<?php
namespace PRIME\Widgets\Webarch\Misc;
use PRIME\Widgets\WidgetBase as WidgetBase;

class CrudAdvertisersController extends WidgetBase
{    
    public function initialize()
    {
        $this->icon ="fa-table";
        
        $this->form_struct ='{"parm":
        [
        {"name":"table","label":"Table Select","type":"table" }
        ]}';
    }
    
}
