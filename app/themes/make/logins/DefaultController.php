<?php
                    namespace PRIME\Themes\Make\Logins;
                    use PRIME\Themes\LoginBase as LoginBase;

                    class DefaultController extends LoginBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/color_picker","name":"login_colour","label":"Login Background Colour"},{"type":"parameters/input","name":"description","label":"Description"},{"type":"parameters/image_upload","name":"logo","label":"Logo","height":"31","width":"195"},{"type":"parameters/image_upload","name":"background","label":"Background Image","height":"768","width":"1024"}]';
                        }
                    }