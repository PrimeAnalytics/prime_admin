<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" class=" portlets" >  <style type="text/css">
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
 </style>    
              <div class=" portlets">
                  <div class="panel">
                    <div class="panel-header panel-controls">
                      <h3><?php echo $parm['title']; ?></h3>
                    </div>
                    <div class="panel-content">
                        <div class="tab_right">
                    <?php $tabs = explode(',', $parm['tabs']) ?>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-primary">
                        <?php foreach ($tabs as $key => $tab) { ?>
                        <li class="<?php if ($key == 0) { ?>active<?php } ?>">
                        <a data-toggle="tab" href="#tab<?php echo $portlet->id; ?>-<?php echo str_replace (" ","_",$key) ?>"><span><?php echo $tab; ?></span></a>
                        </li>
                        <?php } ?>
                    </ul>
                      <div class="tab-content">
                        <?php foreach ($tabs as $key => $tab) { ?>
                        <div class="tab-pane fade <?php if ($key == 0) { ?>active<?php } ?>" id="tab<?php echo $portlet->id; ?>-<?php echo str_replace (" ","_",$key) ?>">
                       <?php echo $region[$key]; ?>
                      </div>
                        <?php } ?>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                
    <?php echo $this->getContent(); ?></div>