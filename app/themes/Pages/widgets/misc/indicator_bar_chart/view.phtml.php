<div id="widget_<?php echo $widget->id; ?>" class="m-b-10 <?php echo $parm['width']; ?> "  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
                    <div class="ar-2-1">
                      <!-- START WIDGET -->
                      <div class="widget-5 panel no-border  widget-loader-bar">
                        <div class="panel-heading pull-top top-right">
                          <div class="panel-controls">
                            <ul>
<li>
<a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a>
                              </li>
                            </ul>
</div>
                        </div>
                        <div class="container-xs-height full-height">
                          <div class="row row-xs-height">
                            <div class="col-xs-5 col-xs-height col-middle relative">
                              <div class="padding-15 top-left bottom-left">
                                <h5 class="hint-text no-margin p-l-10">Italy, Florence</h5>
                                <p class=" bold font-montserrat p-l-10">2,345,789
                                  <br>USD</p>
                                <p class=" hint-text visible-xlg p-l-10">Today's sales</p>
                              </div>
                            </div>
                            <div class="col-md-7 col-xs-height col-bottom relative ">
                              <div id="w_<?php echo $widget->id; ?>"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END WIDGET -->
                    </div>
                  <script>         
          // widget 5
            (function() {
                var container = '#w_<?php echo $widget->id; ?>';

                var datain=[

         <?php foreach ($parm['db'] as $row) { ?>
    {x:Date.parse('<?php echo $this->escaper->escapeJs($row['x_axis']); ?>'),y:<?php echo $this->escaper->escapeJs($row['y_axis']); ?>} ,
        <?php } ?>
];

                var graph = new Rickshaw.Graph({
                    element: document.querySelector(container),
                    renderer: 'bar',
                    series: [{
                        data:datain,
                        color: $.Pages.getColor('danger')
                    }]

                });


                var MonthBarsRenderer = Rickshaw.Class.create(Rickshaw.Graph.Renderer.Bar, {
                    barWidth: function(series) {

                        return 7;
                    }
                });


                graph.setRenderer(MonthBarsRenderer);


                graph.render();


                $(window).resize(function() {
                    graph.configure({
                        width: $(container).width(),
                        height: $(container).height()
                    });

                    graph.render()
                });

                $(container).data('chart', graph);

            })();
            
            </script> <?php echo $this->getContent(); ?></div>