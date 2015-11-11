<div id="widget_<?php echo $widget->id; ?>" class=" m-b-10 <?php echo $parm['width']; ?> "  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
                    <div class="ar-1-1">
                         <div class="widget-3 panel no-border no-margin widget-loader-bar" style="background-color:<?php echo $parm['tile_color']; ?>">
                        <div class="panel-body no-padding">
                          <div class="metro live-tile" data-mode="carousel" data-start-now="true" data-delay="3000">

                  <?php foreach ($parm['db']['0']['tiles'] as $key => $value) { ?>
                  
                  <div class="slide-back tiles">
                                <div class="padding-30">

                                    <div class="pull-bottom p-b-30">
                                        <h3 class="no-margin text-white p-b-10">
                                            <?php echo ucwords($key); ?></h3>
                                            <h3 class="no-margin text-white p-b-10"><span class="semi-bold"><?php echo $value; ?></span></h3>
                                        
                                    </div>
                                </div>
                            </div>
                  
                  <?php } ?>
                          </div>
                        </div>
                      </div>
                      </div>
                  <script>
$(".widget-3 .metro").liveTile();
</script><?php echo $this->getContent(); ?></div>