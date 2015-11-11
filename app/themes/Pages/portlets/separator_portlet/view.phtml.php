<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" class=" sm-no-padding" > 
                  <div class="panel panel-transparent" style="background-color:<?php echo $parm['color']; ?>">
                    <div class="panel-body no-padding">
                      <div id="portlet-advance" class="panel panel-default">
                        <div class="panel-heading separator">
                          <div class="panel-title"><?php echo $parm['title']; ?>
                          </div>
                          <div class="panel-controls">
                            <ul>
<li>
<a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a>
                              </li>
                              <li>
<a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a>
                              </li>
                              <li>
<a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a>
                              </li>
                            </ul>
</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                            <?php echo $region[0]; ?>
                            </div>
                            <div class="row">
                            <?php echo $region[1]; ?>
                            </div>
                            <div class="row">
                            <?php echo $region[2]; ?>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  <?php echo $this->getContent(); ?></div>