<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" > 
				<div>
				    <?php $tabs = explode(',', $parm['tabs']) ?>
                      <h3><?php echo $parm['title']; ?></h3>
                      <div class="panel-group panel-accordion" id="accordion<?php echo $portlet->id; ?>">
                          <?php foreach ($tabs as $key => $tab) { ?>
                          
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4>
                              <a class="collapsed" data-toggle="collapse" data-parent="#accordion<?php echo $portlet->id; ?>" href="#tab<?php echo $portlet->id; ?>-<?php echo str_replace (" ","_",$key) ?>">
                              <?php echo $tab; ?>
                              </a>
                            </h4>
                          </div>
                          <div id="tab<?php echo $portlet->id; ?>-<?php echo str_replace (" ","_",$key) ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                              <?php echo $region[$key]; ?>
                            </div>
                          </div>
                        </div>
                        
                        <?php } ?>

                      </div>
                    </div>
				
<?php echo $this->getContent(); ?></div>