<div id="widget_<?php echo $widget->id; ?>" class="m-b-10 <?php echo $parm['width']; ?> "  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
                    <!-- START WIDGET -->
                    <div class="widget-9 panel no-border bg-primary no-margin widget-loader-bar">
                      <div class="container-xs-height full-height">
                        <div class="row-xs-height">
                          <div class="col-xs-height col-top">
                            <div class="panel-heading  top-left top-right">
                              <div class="panel-title text-black">
                                <span class="font-montserrat fs-11 all-caps"><?php echo $parm['title']; ?> <i class="fa fa-chevron-right"></i>
                                                    </span>
                              </div>
                              <div class="panel-controls">
                                <ul>
<li>
<a href="#" class="portlet-refresh text-black" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a>
                                  </li>
                                </ul>
</div>
                            </div>
                          </div>
                        </div>
                        <div class="row-xs-height">
                          <div class="col-xs-height col-top">
                            <div class="p-l-20 p-t-15">
                              <h3 class="no-margin p-b-5 text-white"><?php echo $parm['db']['0']['value']; ?></h3>
                              <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                                                        </a>
                              <span class="small hint-text"><?php if (($parm['db']['0']['max'] != 0)) { ?><?php echo ($parm['db']['0']['value'] / $parm['db']['0']['max']) * 100; ?><?php } else { ?> 0 <?php } ?>%</span>
                            </div>
                          </div>
                        </div>
                        <div class="row-xs-height">
                          <div class="col-xs-height col-bottom">
                            <div class="progress progress-small m-b-20">
                              <!-- START BOOTSTRAP PROGRESS (http://getbootstrap.com/components/#progress) -->
                              <div class="progress-bar progress-bar-white" style="width:<?php if (($parm['db']['0']['max'] != 0)) { ?><?php echo ($parm['db']['0']['value'] / $parm['db']['0']['max']) * 100; ?><?php } else { ?> 0 <?php } ?>%"></div>
                              <!-- END BOOTSTRAP PROGRESS -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END WIDGET -->
                  <?php echo $this->getContent(); ?></div>