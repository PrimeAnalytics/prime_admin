<div id="portlet_<?php echo $portlet->id; ?>"  >     
            <div >
              <div class="panel" style="background-color:<?php echo $parm['color']; ?>">
                <div class="panel-header">
                  <h3><?php echo $parm['title']; ?></h3>
                </div>
                <div class="panel-content">
                 <div class="row">
                            <?php echo $region[0]; ?>
                            </div>
                            <div class="row">
                            <?php echo $region[1]; ?>
                            </div>
                            <div class="row">
                            <div class="col-md-8">
                            <?php echo $region[2]; ?>
                            </div>
                            <div class="col-md-4">
                            <?php echo $region[3]; ?>
                            </div>
                            </div>
                 </div>
              </div>
            </div>
            <?php echo $this->getContent(); ?></div>