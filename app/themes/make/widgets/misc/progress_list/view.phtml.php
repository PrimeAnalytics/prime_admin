<div id="widget_<?php echo $widget->id; ?>"  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?><style>
#w_<?php echo $widget->id; ?> .ui-selecting.item_<?php echo $widget->id; ?> { background: #FECA40; }
  #w_<?php echo $widget->id; ?> .ui-selected.item_<?php echo $widget->id; ?> { background: #F39814; color: white; }
</style>

<div>
    
    <?php  $max =array();  ?>
    
    <?php foreach ($parm['db'] as $entry) { ?>
    
         <?php  $max[] = $entry['value']; ?>

<?php } ?>
    
    <?php 
    if(max($max)>0) 
    { 
    $max=max($max);
    }
    else
    {
    $max=1;
    }
    ?>
    

                <div class="widget-progress-bar">
                  <div id="scroll_<?php echo $widget->id; ?>" style="height:400px;">
                      <div id="w_<?php echo $widget->id; ?>">
                <?php foreach ($parm['db'] as $entry) { ?>
                    <div class="item_<?php echo $widget->id; ?>" data-link="<?php echo $entry['label']; ?>" style="padding:10px">
                    <div class="clearfix" >
                      <div class="title"><?php echo $entry['label']; ?></div>
                      <div class="number"><?php echo round($entry['value']) ?></div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-primary stat1" data-transitiongoal="82" aria-valuenow="82" style="width: <?php echo ($entry['value'] * 100) / $max; ?>%;"></div>
                    </div>
                    </div> 
                    
                <?php } ?>
                 </div>
                  </div>
                </div>
                      
</div>
</div>
  <script>
  $(function() {
    $( "#w_<?php echo $widget->id; ?>" ).selectable({
      stop: function() {
        var link_set=[];
        $( "div.ui-selected.item_<?php echo $widget->id; ?>", this ).each(function() {
            link_set.push($(this).data('link'));
        });
        
     update_dashboard("<?php echo $parm['target_link']; ?>", link_set,<?php echo $widget->id; ?>);
        
        
      }
    });
        $("#scroll_<?php echo $widget->id; ?>").mCustomScrollbar();
  });
  
  </script>
  
<?php echo $this->getContent(); ?></div>