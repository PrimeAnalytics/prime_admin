<div id="widget_<?php echo $widget->id; ?>"   > <?php echo $controls; ?><div>
    
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

            update_dashboard("<?php echo $parm['link_table']; ?>","<?php echo $parm['target_link']; ?>","=", this.value,<?php echo $widget->id; ?>);
  
        });
        
        function submit_<?php echo $widget->id; ?>(multiple)
        {
            return $("#w_<?php echo $widget->id; ?>").val();
        }

</script><?php echo $this->getContent(); ?></div>