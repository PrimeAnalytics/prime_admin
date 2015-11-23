<div id="widget_<?php echo $widget->id; ?>" class="<?php echo $parm['width']; ?>" ><?php echo $controls; ?>
<style>
#w_<?php echo $widget->id; ?> .ui-selecting { background: #FECA40; }
  #w_<?php echo $widget->id; ?> .ui-selected { background: #F39814; color: white; }
</style><div id="scroll_<?php echo $widget->id; ?>" style="max-height:400px; overflow: auto; overflow-x: hidden;">
<nav  >
				<ul id="w_<?php echo $widget->id; ?>" class="met_clean_list sf-js-enabled sf-arrows">
				    
				    <?php foreach ($parm['db'] as $entry) { ?>
				    <li data-link="<?php echo $entry['link_column']; ?>"><a><?php echo $entry['value']; ?></a></li>
<?php } ?>
				</ul>
			</nav>
			</div>
  
  <script>
  $(function() {
    $( "#w_<?php echo $widget->id; ?>" ).selectable({
      stop: function() {
        var link_set=[];
        $( "li.ui-selected", this ).each(function() {
            link_set.push($(this).data('link'));
        });
        
     update_dashboard("<?php echo $parm['target_link']; ?>", link_set,<?php echo $widget->id; ?>);
        
        
      }
    });
            $("#scroll_<?php echo $widget->id; ?>").mCustomScrollbar({theme:"minimal-dark"});
  });
  </script>
  
<?php echo $this->getContent(); ?></div>