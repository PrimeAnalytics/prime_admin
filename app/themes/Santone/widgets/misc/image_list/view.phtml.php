<div id="widget_<?php echo $widget->id; ?>" class="<?php echo $parm['width']; ?>" ><?php echo $controls; ?>
<style>
#w_<?php echo $widget->id; ?> .ui-selecting { background: #FECA40; }
  #w_<?php echo $widget->id; ?> .ui-selected { background: #F39814; color: white; }
</style><div id="scroll_<?php echo $widget->id; ?>" style="max-height:400px; overflow: auto; overflow-x: hidden;">
				<div id="w_<?php echo $widget->id; ?>" class="met_sidebar_block">
				    
				    <?php foreach ($parm['db'] as $entry) { ?>
				    
			    <div class="met_comment_box">
					<div class="met_comment clearfix">
						<img src="<?php echo $entry['image']; ?>" alt="">
						<div class="clearfix met_comment_descr">
							<div class="met_comment_text"><?php echo $entry['comment']; ?></div>
						</div>
					</div>
				</div>
				    
				    
<?php } ?>
				</div>
			</div>
			
		
  
  <script>
  $(function() {
    $( "#w_<?php echo $widget->id; ?>" ).selectable({
      stop: function() {
        var link_set=[];
        $( "div.ui-selected", this ).each(function() {
            link_set.push($(this).data('link'));
        });
        
     update_dashboard("<?php echo $parm['target_link']; ?>", link_set,<?php echo $widget->id; ?>);
        
        
      }
    });
            $("#scroll_<?php echo $widget->id; ?>").mCustomScrollbar({theme:"minimal-dark"});
  });
  </script>
  
<?php echo $this->getContent(); ?></div>