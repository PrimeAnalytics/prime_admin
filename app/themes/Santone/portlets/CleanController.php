<?php
                    namespace PRIME\Themes\Santone\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class CleanController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"title","label":"Title"}]';
                        }
                    }