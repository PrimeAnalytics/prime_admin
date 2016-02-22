<?php
                    namespace PRIME\Themes\Make\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class ColoredFooterController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/color_picker","name":"color","label":"Panel  Color"}]';
                        }
                    }