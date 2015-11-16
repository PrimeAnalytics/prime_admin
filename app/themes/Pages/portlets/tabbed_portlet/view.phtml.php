<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" >  <style type="text/css">
.tab-content > .tab-pane,
.pill-content > .pill-pane {
    display: block;     /* undo display:none          */
    height: 0;          /* height:0 is also invisible */ 
    overflow-y: hidden; /* no-overflow                */
}
.tab-content > .active,
.pill-content > .active {
    height: auto;       /* let the content decide it  */
}   
 </style>             <div >
              <!-- START PANEL -->
              <div class="panel panel">
                <div class="panel-heading ">
                  <div class="panel-title"><?php echo $parm['title']; ?>
                  </div>
                  <div class="panel-controls">
                    <ul>
                      <li><a  class="portlet-collapse" data-toggle="collapse"><i class="pg-arrow_maximize"></i></a>
                      </li>
                      <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="pg-refresh_new"></i></a>
                      </li>
                      <li><a href="#" class="portlet-close" data-toggle="close"><i class="pg-close"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="panel-body">
                    
                    <?php $tabs = explode(',', $parm['tabs']) ?>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-linetriangle">
                        <?php foreach ($tabs as $key => $tab) { ?>
                        <li class="<?php if ($key == 0) { ?>active<?php } ?>">
                        <a onclick="tabchange()" data-toggle="tab" href="#tab-<?php echo str_replace (" ","_",$key) ?>"><span><?php echo $tab; ?></span></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- Tab panes -->
                    
                    <div class="tab-content no-padding">
                        
                         <?php foreach ($tabs as $key => $tab) { ?>
                        <div class="tab-pane <?php if ($key == 0) { ?>active<?php } ?>" id="tab-<?php echo str_replace (" ","_",$key) ?>">
                       <?php echo $region[$key]; ?>
                      </div>
                        <?php } ?>
                    </div>
   
                </div>
              </div>
              <!-- END PANEL --><?php echo $this->getContent(); ?></div>