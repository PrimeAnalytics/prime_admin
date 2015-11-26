<div id="widget_<?php echo $widget->id; ?>" class="col-md-<?php echo $parm['width']; ?> <?php echo $parm['width']; ?> "  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?><div class="col-md-<?php echo $parm['width']; ?>">
<select id="w_<?php echo $widget->id; ?>" style="width:100%" class="input" multiple="multiple" placeholder="<?php echo $parm['title']; ?>">
     <?php foreach ($parm['db'] as $entry) { ?>
      <option value="<?php echo $entry['values']; ?>"><?php echo $entry['values']; ?></option>
    <?php } ?>
</select>
</div><script>

$("#w_<?php echo $widget->id; ?>").select2();

        $("#w_<?php echo $widget->id; ?>").change(function() {
        
            update_dashboard("<?php echo $parm['target_link']; ?>", $("#w_<?php echo $widget->id; ?>").select2("val"),<?php echo $widget->id; ?>);
  
        });



</script><?php echo $this->getContent(); ?></div>