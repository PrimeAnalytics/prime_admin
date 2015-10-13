<?php
namespace PRIME\Themes\Testtheme\Portlets;
use PRIME\Themes\PortletBase as PortletBase;

class DsffvsdController extends PortletBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/dashboard_select"}]';
    }
}