<?php
                    namespace PRIME\Themes\Pages\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class TabbedPortletController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/select","name":"width","label":"Panel Width","values":"1,2,3,4,5,6,7,8,9,10,11,12"},{"type":"parameters/input","name":"tabs","label":"Tabs (seperated by comma)"}]';
                        }
                    }