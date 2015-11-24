<?php
                    namespace PRIME\Themes\Make\Dashboards;
                    use PRIME\Themes\DashboardBase as DashboardBase;

                    class DefaultController extends DashboardBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image","height":"31","width":"230"}]';
                        }
                    }