<div id="widget_<?php echo $widget->id; ?>"  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?><div>
<h3>
  <?php echo $parm['title']; ?>
</h3>

<select id="w_<?php echo $widget->id; ?>" class="input form-control">
     <?php foreach ($parm['db'] as $entry) { ?>
      <option value="<?php echo $entry['values']; ?>"><?php echo $entry['values']; ?></option>
    <?php } ?>
      
</select>
</div><script>

        $("#w_<?php echo $widget->id; ?>").change(function() {

            update_dashboard("<?php echo $parm['target_link']; ?>", this.value,<?php echo $widget->id; ?>);
  
        });

</script><?php echo $this->getContent(); ?></div>