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
                    <?php $tabs = explode(',', $parm['tabs']) ?>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <?php foreach ($tabs as $key => $tab) { ?>
                        <li class="<?php if ($key == 0) { ?>active<?php } ?>">
                        <a onclick="tabchange()" data-toggle="tab" href="#tab-<?php echo str_replace (" ","_",$key) ?>"><span><?php echo $tab; ?></span></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- Tab panes -->
                    
                    <div class="tab-content no-padding">
                        
                         <?php foreach ($tabs as $key => $tab) { ?>
                        <div class="tab-pane fade <?php if ($key == 0) { ?>in active<?php } ?>" id="tab-<?php echo str_replace (" ","_",$key) ?>">
                       <?php echo $region[$key]; ?>
                      </div>
                        <?php } ?>
                    </div>
   
                </div>

  <?php echo $this->getContent(); ?></div>