<div id="widget_<?php echo $widget->id; ?>"class="col-md-<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
<div id="w_<?php echo $widget->id; ?>" style="width:100% min-width: 600px; height: 500px; margin: 0 auto"></div>
<script>
selectedPoints = [];
$('#w_<?php echo $widget->id; ?>').highcharts({
            chart: {
            type: 'pie',
            spacingBottom: 50,
            spacingTop: 50,
            spacingLeft: 50,
            spacingRight: 50,
			zoomType: 'xy'
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
                            temp.push(value.name);
                        });
                        
                             update_dashboard("<?php echo $parm['target_link']; ?>", temp,<?php echo $widget->id; ?>);
                    },
                    unselect: function (event) {
                        
                        var index = selectedPoints.indexOf(this);
                        if (index > -1) {
                            selectedPoints.splice(index, 1);
                            var temp=[];
                        $.each(selectedPoints, function (i, value) {
                            temp.push(value.name);
                        });
                            update_dashboard("<?php echo $parm['target_link']; ?>", temp,<?php echo $widget->id; ?>);
                        }
                        
                    }
                }
            }
        }
    },
 title: {
            text: '<?php echo $parm['chart_title']; ?>'
        },
        		  credits: {
  enabled: false
  },
    colors:<?php echo $parm['colors']; ?>,
  series: [{
     data: [
<?php foreach ($parm['db'] as $row) { ?>
{
     name: '<?php echo $this->escaper->escapeJs($row['label']); ?>',
     y: <?php echo $this->escaper->escapeJs($row['value']); ?>
},
<?php } ?>
]}]
});
</script><?php echo $this->getContent(); ?></div>