<?php
namespace PRIME\Themes\Testtheme\Portlets;
use PRIME\Themes\PortletBase as PortletBase;

class TestportletController extends PortletBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/color_select","name":"portlet_color","label":"Select Color"}]';
    }
}