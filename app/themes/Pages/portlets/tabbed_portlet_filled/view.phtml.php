<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" > 
              <!-- START PANEL -->
              <div class="panel panel">
                <div class="panel-heading ">
                  <div class="panel-title"><?php echo $parm['title']; ?>
                  </div>
                  <div class="panel-controls">
                    <ul>
<li>
<a class="portlet-collapse" data-toggle="collapse"><i class="pg-arrow_maximize"></i></a>
                      </li>
                      <li>
<a href="#" class="portlet-refresh" data-toggle="refresh"><i class="pg-refresh_new"></i></a>
                      </li>
                      <li>
<a href="#" class="portlet-close" data-toggle="close"><i class="pg-close"></i></a>
                      </li>
                    </ul>
</div>
                </div>
                <div class="panel-body">
                    
                    <?php $tabs = explode(',', $parm['tabs']) ?><!-- Nav tabs --><ul class="nav nav-tabs nav-tabs-fillup">
                        <?php foreach ($tabs as $key => $tab) { ?>
                        <li class="<?php if ($key == 0) { ?>active<?php } ?>">
                        <a onclick="tabchange()" data-toggle="tab" href="#tab-<?php echo $tab; ?>"><span><?php echo $tab; ?></span></a>
                        </li>
                        <?php } ?>
                    </ul>
<!-- Tab panes --><div class="tab-content no-padding">
                        
                         <?php foreach ($tabs as $key => $tab) { ?>
                        <div class="tab-pane <?php if ($key == 0) { ?>active<?php } ?>" id="tab-<?php echo $key; ?>">
                       <?php echo $region[$key]; ?>
                      </div>
                        <?php } ?>
                    </div>
   
                </div>
              </div>
              <!-- END PANEL --><?php echo $this->getContent(); ?></div>