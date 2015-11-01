<div id="w_<?php echo $widget->id; ?>"><svg></svg></div><script>






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
                    var chart = nv.models.lineChart()
                        .useInteractiveGuideline(true);

                    d3.select('#w_<?php echo $widget->id; ?> svg')
                        .datum(datain)
                        .transition().duration(500)
                        .call(chart);

                    nv.utils.windowResize(chart.update);

                    $('#w_<?php echo $widget->id; ?>').data('chart', chart);

                    return chart;
                });
            })();




</script><?php echo $this->getContent(); ?>