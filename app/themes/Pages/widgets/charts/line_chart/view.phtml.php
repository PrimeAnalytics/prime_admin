<div id="widget_<?php echo $widget->id; ?>"class="col-md-<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
<div id="w_<?php echo $widget->id; ?>" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div>
<script>
$('#w_<?php echo $widget->id; ?>').highcharts({
            chart: {
            type: '<?php echo $parm['chart_type']; ?>',
            spacingBottom: 50,
            spacingTop: 50,
            spacingLeft: 50,
            spacingRight: 50,
            events: {
            selection: function(event) {
                for (var i = 0; i < this.series[0].data.length; i++) {
                    var point = this.series[0].data[i];
                    if (point.x > event.xAxis[0].min &&
                        point.x < event.xAxis[0].max &&
                        point.y > event.yAxis[0].min &&
                        point.y < event.yAxis[0].max) {
                            point.select(true, true);
                        }
                    
                }
                return false;
            }
        },
			zoomType: 'xy'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
 title: {
            text: '<?php echo $parm['chart_title']; ?>'
        },
        plotOptions: {
        series: {
            allowPointSelect: true,
            point: {
                events: {
                    select: function (event) {
                        var chart = this.series.chart;
                        if (event.accumulate) {
                            selectedPoints.push(this);
                        } else {
                            selectedPoints = [this];
                        }
                        var temp=[];
                        $.each(selectedPoints, function (i, value) {
                            temp.push(value.x);
                        });
                        
                             update_dashboard("<?php echo $parm['target_link']; ?>", temp,<?php echo $widget->id; ?>);
                    },
                    unselect: function (event) {
                        
                        var index = selectedPoints.indexOf(this);
                        if (index > -1) {
                            selectedPoints.splice(index, 1);
                            var temp=[];
                        $.each(selectedPoints, function (i, value) {
                            temp.push(value.x);
                        });
                            update_dashboard("<?php echo $parm['target_link']; ?>", temp,<?php echo $widget->id; ?>);
                        }
                        
                    }
                }
            }
        }
    },
        		  credits: {
  enabled: false
  },
        xAxis: {
            title: {
                text: '<?php echo $parm['x_label']; ?>'
            },
            
                <?php if ($parm['xtype'] == 'Date') { ?>
                type: 'datetime',
                <?php } elseif ($parm['xtype'] == 'Category') { ?>
                type: 'datetime',
                <?php } else { ?>
                <?php } ?>
            
        },
        yAxis: {
            title: {
                text: '<?php echo $parm['y_label']; ?>'
            }
        },
        colors:<?php echo $parm['colors']; ?>,
 series: [
<?php foreach ($parm['db'] as $key => $series) { ?>
{
     name: '<?php echo $this->escaper->escapeJs($key); ?>',
     data: [
        <?php foreach ($series as $row) { ?>
        
                <?php if ($parm['xtype'] == 'Date') { ?>
    [Date.parse('<?php echo $this->escaper->escapeJs($row['x_axis']); ?>'),<?php echo $this->escaper->escapeJs($row['value']); ?>] ,
                <?php } elseif ($parm['xtype'] == 'Category') { ?>
    ['<?php echo $this->escaper->escapeJs($row['x_axis']); ?>',<?php echo $this->escaper->escapeJs($row['value']); ?>] ,
                <?php } else { ?>
    [<?php echo $this->escaper->escapeJs($row['x_axis']); ?>,<?php echo $this->escaper->escapeJs($row['value']); ?>] ,
                <?php } ?>
        <?php } ?>
]},

<?php } ?>
]

});
</script><?php echo $this->getContent(); ?></div>