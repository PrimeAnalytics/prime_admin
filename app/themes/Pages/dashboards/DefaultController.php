<?php
namespace PRIME\Themes\Pages\Dashboards;
use PRIME\Themes\DashboardBase as DashboardBase;

class DefaultController extends DashboardBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image"},{"type":"parameters/image_upload","name":"logo","label":"Logo"}]';
    }
}