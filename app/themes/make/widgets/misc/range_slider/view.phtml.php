<div id="widget_<?php echo $widget->id; ?>" class="warning <?php echo $parm['width']; ?> "  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?><div style="width:100%" class="warning">
                        <input id="w_<?php echo $widget->id; ?>" class="range-slider"  />
                      </div><script>
$("#w_<?php echo $widget->id; ?>").ionRangeSlider({
    type: "double",
    grid: true
});

</script><?php echo $this->getContent(); ?></div>