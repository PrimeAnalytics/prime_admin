                      <div class="col-md-<?php echo $parm['width']; ?>">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <div class="panel-title"><?php echo $parm['title']; ?>
                            </div>
                            <div class="panel-controls">
                              <ul>
                                <li><a data-toggle="close" class="portlet-close" href="#"><i class="portlet-icon portlet-icon-close"></i></a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="panel-body">
                              <div class="col-md-12">
                             <?php echo $region[0]; ?>
                             </div>
                             </div>
                        </div>
                      </div><?php echo $this->getContent(); ?>