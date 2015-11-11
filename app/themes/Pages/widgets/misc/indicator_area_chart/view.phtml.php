<div id="widget_<?php echo $widget->id; ?>" class="m-b-10 <?php echo $parm['width']; ?> "  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
                    <div class="ar-2-1">
                      <!-- START WIDGET -->
                      <div class="widget-4 panel no-border  no-margin widget-loader-bar">
                        <div class="container-sm-height full-height">
                          <div class="row-sm-height">
                            <div class="col-sm-height col-top">
                              <div class="panel-heading ">
                                <div class="panel-title text-black hint-text">
                                  <span class="font-montserrat fs-11 all-caps"><?php echo $parm['title']; ?><i class="fa fa-chevron-right"></i>
                                                        </span>
                                </div>
                                <div class="panel-controls">
                                  <ul>
<li>
<a href="#" class="portlet-refresh text-black" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a>
                                    </li>
                                  </ul>
</div>
                              </div>
                            </div>
                          </div>
                          <div class="row-sm-height">
                            <div class="col-sm-height col-bottom ">
                              <div id="w_<?php echo $widget->id; ?>" class="line-chart " data-line-color="success" data-area-color="success-light" data-y-grid="false" data-points="false" data-stroke-width="2">
                                <svg></svg>
</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END WIDGET -->
                    </div>
                              <script>
            (function() {
                
                
                var datain=[
{
     "values": [
         <?php foreach ($parm['db'] as $row) { ?>
    {x:Date.parse('<?php echo $this->escaper->escapeJs($row['x_axis']); ?>'),y:<?php echo $this->escaper->escapeJs($row['y_axis']); ?>} ,
        <?php } ?>
]}
];
                
                
                nv.addGraph(function() {
                    var chart = nv.models.lineChart()
                        .color([
                            $.Pages.getColor('success')
                        ])
                        .useInteractiveGuideline(true)

                    .margin({
                            top: 60,
                            right: -10,
                            bottom: -10,
                            left: -10
                        })
                        .showLegend(false);


                    d3.select('#w_<?php echo $widget->id; ?> svg')
                        .datum(datain)
                        .transition().duration(500)
                        .call(chart);


                    nv.utils.windowResize(function() {

                        chart.update();

                    });

                    $('#w_<?php echo $widget->id; ?>').data('chart', chart);

                    return chart;
                }, function() {

                });
            })();
            </script><?php echo $this->getContent(); ?></div>