<div id="widget_<?php echo $widget->id; ?>"  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
<style>
#w_<?php echo $widget->id; ?> .ui-selecting { background: #FECA40; }
  #w_<?php echo $widget->id; ?> .ui-selected { background: #F39814; color: white; }
</style><div>
    <div class="panel-content widget-news" id="scroll_<?php echo $widget->id; ?>" style="max-height:400px">
                  <div id="w_<?php echo $widget->id; ?>" >
                      				    <?php foreach ($parm['db'] as $entry) { ?>
                      				    
                    <a data-link="<?php echo $entry['value']; ?>" class="message-item media">
                      <div class="media">
                        <div class="media-body">
                          <div>
                            <h4 class="c-dark"><?php echo $entry['value']; ?></h4>
                         
                          </div>
                        </div>
                      </div>
                    </a>
<?php } ?>
                    

                  </div>
                </div>
    
			</div>
  
  <script>
  $(function() {
    $( "#w_<?php echo $widget->id; ?>" ).selectable({
      stop: function() {
        var link_set=[];
        $( "a.ui-selected", this ).each(function() {
            link_set.push($(this).data('link'));
        });
        
     update_dashboard("<?php echo $parm['target_link']; ?>", link_set,<?php echo $widget->id; ?>);
        
        
      }
    });
    
    $("#scroll_<?php echo $widget->id; ?>").mCustomScrollbar();
    
    
    
  });
  </script>
  
<?php echo $this->getContent(); ?></div>