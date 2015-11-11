<?php
                    namespace PRIME\Themes\Pages\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class TabbedPortletFilledController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/input","name":"tabs","label":"Tabs (seperated by comma)"}]';
                        }
                    }