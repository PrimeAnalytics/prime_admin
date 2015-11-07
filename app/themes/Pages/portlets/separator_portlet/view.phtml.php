<div id="portlet_<?php echo $portlet->id; ?>"class="col-md-<?php echo $parm['width']; ?>" > 
                    <div class="panel panel-default">
                      <div class="panel-heading separator">
                        <div class="panel-title"><?php echo $parm['title']; ?>
                        </div>
                      </div>
                      <div class="panel-body" style="height: inherit;">
                          <div class="col-md-12">
                      <?php echo $region[0]; ?>
                      </div>
 <div class="col-md-12">
                      <?php echo $region[1]; ?>
                      </div>
                       <div class="col-md-12">
                      <?php echo $region[2]; ?>
                      </div>
                      </div>
                    </div>
                  <?php echo $this->getContent(); ?></div>