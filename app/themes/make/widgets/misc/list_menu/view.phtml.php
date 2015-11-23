<div id="widget_<?php echo $widget->id; ?>"  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?><style>
#w_<?php echo $widget->id; ?> .ui-selecting { background: #FECA40; }
  #w_<?php echo $widget->id; ?> .ui-selected { background: #F39814; color: white; }
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
    
    <style>
    
    td {
    position: relative;
}
.rowprogress {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    background-color: green;
     opacity: 0.2;
    z-index: 99;
}
</style>

                <div class="widget-table">
                  <div id="scroll_<?php echo $widget->id; ?>" style="height:400px">
<table class="table table-hover">
    <tbody id="w_<?php echo $widget->id; ?>">
<?php foreach ($parm['db'] as $entry) { ?>
 <tr data-link="<?php echo $entry['label']; ?>"> 
    <td ><div class="rowprogress" style="width:<?php echo ($entry['value'] * 100) / $max; ?>%"></div> <?php echo $entry['label']; ?> </td>
 </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
  <script>
  $(function() {
    $( "#w_<?php echo $widget->id; ?>" ).selectable({
      stop: function() {
        var link_set=[];
        $( "tr.ui-selected", this ).each(function() {
            link_set.push($(this).data('link'));
        });
        
     update_dashboard("<?php echo $parm['target_link']; ?>", link_set,<?php echo $widget->id; ?>);
        
        
      }
    });
        $("#scroll_<?php echo $widget->id; ?>").mCustomScrollbar();
  });
  
  </script>
  
<?php echo $this->getContent(); ?></div>