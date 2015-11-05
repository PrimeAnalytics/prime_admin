
<h3>
  <?php echo $parm['title']; ?>
</h3>

<select id="w_<?php echo $widget->id; ?>" class="input form-control">
     <?php foreach ($parm['db'] as $entry) { ?>
      <option value="<?php echo $entry['link_column']; ?>"><?php echo $entry['values']; ?></option>
    <?php } ?>
      
</select><script>

        $("#w_<?php echo $widget->id; ?>").change(function() {

            update_dashboard("<?php echo $parm['target_link']; ?>", this.value);
  
        });

        $("#w_<?php echo $widget->id; ?>" ).change();

</script><?php echo $this->getContent(); ?>