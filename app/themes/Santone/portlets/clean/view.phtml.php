<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" > 
							<div class="met_title">
								<h2><?php echo $parm['title']; ?></h2>
							</div>

							<div class="met_skills">
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
						<?php echo $this->getContent(); ?></div>