<?php
                    namespace PRIME\Themes\Pages\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class BasicPortletController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/select","name":"width","label":"Width","values":"1,2,3,4,6,8,12"}]';
                        }
                    }