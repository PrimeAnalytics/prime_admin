<div id="widget_<?php echo $widget->id; ?>"   > <?php echo $controls; ?><div>
<h3>
  <?php echo $parm['title']; ?>
</h3>

<input id="w_<?php echo $widget->id; ?>" class="input form-control">
</input>
</div><script>
        
        function submit_<?php echo $widget->id; ?>(multiple)
        {
            return $("#w_<?php echo $widget->id; ?>").val();
        }

</script><?php echo $this->getContent(); ?></div>