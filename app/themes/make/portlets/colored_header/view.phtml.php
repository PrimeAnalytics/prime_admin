<div id="portlet_<?php echo $portlet->id; ?>"  style="height:100%" >     
            <div style="height:100%" >
              <div class="panel" >
                <div class="panel-header" style="background-color:<?php echo $parm['color']; ?>">
                  <h3><?php echo $parm['title']; ?></h3>
                </div>
                <div class="panel-content">
                 <div class="row">
                            <?php echo $region[0]; ?>
                            </div>
                 </div>
              </div>
            </div>
            
<?php echo $this->getContent(); ?></div>