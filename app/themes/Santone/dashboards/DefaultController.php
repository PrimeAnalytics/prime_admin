<?php
                    namespace PRIME\Themes\Santone\Dashboards;
                    use PRIME\Themes\DashboardBase as DashboardBase;

                    class DefaultController extends DashboardBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image"}]';
                        }
                    }