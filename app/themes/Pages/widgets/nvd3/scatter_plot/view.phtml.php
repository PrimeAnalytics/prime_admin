<div id="w_<?php echo $widget->id; ?>" style="width:100%;height:500px"><svg></svg></div><script>
(function() {
    
    var datain=[
<?php foreach ($parm['db'] as $key => $series) { ?>
{
     "key": '<?php echo $this->escaper->escapeJs($key); ?>',
     "values": [
        <?php foreach ($series as $row) { ?>
    {x:'<?php echo $this->escaper->escapeJs($row['x_axis']); ?>',y:<?php echo $this->escaper->escapeJs($row['value']); ?>} ,
        <?php } ?>
]},

<?php } ?>
];
    
                nv.addGraph(function() {
                    var chart = nv.models.scatterChart()

                    d3.select('#w_<?php echo $widget->id; ?> svg')
                        .datum(datain)
                        .transition().duration(500)
                        .call(chart);

                                        nv.utils.windowResize(function() {

                        chart.update();

                        var xTicks = d3.select('.nv-y.nv-axis  g').selectAll('g');
                        xTicks
                            .selectAll('text')
                            .attr('transform', function(d, i, j) {
                                return 'translate (10, 0)'
                            });

                        var yTicks = d3.select('.nv-x.nv-axis  g').selectAll('g');
                        yTicks
                            .selectAll('text')
                            .attr('transform', function(d, i, j) {
                                return 'translate (0, 10)'
                            });

                        var minmax = d3.select('.nv-x.nv-axis g');
                        minmax
                            .selectAll('text')
                            .attr('transform', function(d, i, j) {
                                return 'translate (0, 10)'
                            });


                        var legend = d3.select('.nv-legendWrap .nv-legend');
                        legend.attr('transform', function(d, i, j) {
                            return 'translate (0, -20)'
                        });

                    });

                    $('#w_<?php echo $widget->id; ?>').data('chart', chart);

                    return chart;
                });
            })();


</script><?php echo $this->getContent(); ?>