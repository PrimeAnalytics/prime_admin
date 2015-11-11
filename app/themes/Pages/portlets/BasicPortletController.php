<?php
                    namespace PRIME\Themes\Pages\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class BasicPortletController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/color_picker","name":"color","label":"Panel  Color"}]';
                        }
                    }