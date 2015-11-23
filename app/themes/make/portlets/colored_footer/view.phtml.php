<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" >     
            <div >
              <div class="panel" >
                <div class="panel-content">
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
                 <div class="panel-footer" style="background-color:<?php echo $parm['color']; ?>">
                  <h3><?php echo $parm['title']; ?></h3>
                </div>
              </div>
            </div>
            
<?php echo $this->getContent(); ?></div>