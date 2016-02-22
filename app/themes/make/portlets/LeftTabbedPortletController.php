<?php
                    namespace PRIME\Themes\Make\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class LeftTabbedPortletController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/input","name":"tabs","label":"Tabs (seperated by comma)"}]';
                        }
                    }