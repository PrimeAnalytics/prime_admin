<?php
                    namespace PRIME\Themes\Santone\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class ArticleController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/width"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/input","name":"description","label":"Description"}]';
                        }
                    }