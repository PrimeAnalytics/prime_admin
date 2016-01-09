<div id="widget_<?php echo $widget->id; ?>" class="<?php echo $parm['width']; ?>" ><?php echo $controls; ?>
<div id="w_<?php echo $widget->id; ?>" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div>
<script>


    function selectPointsByDrag(e) {

        // Select points
        Highcharts.each(this.series, function (series) {
            Highcharts.each(series.points, function (point) {
                if (point.x >= e.xAxis[0].min && point.x <= e.xAxis[0].max &&
                        point.y >= e.yAxis[0].min && point.y <= e.yAxis[0].max) {
                    point.select(true, true);
                }
            });
        });

        // Fire a custom event
        HighchartsAdapter.fireEvent(this, 'selectedpoints', { points: this.getSelectedPoints() });

        return false; // Don't zoom
    }

    /**
     * The handler for a custom event, fired from selection event
     */
    function selectedPoints(e) {
        var temp=[];
                        $.each(e.points, function (i, value) {
                            
                <?php if ($parm['xtype'] == 'Date') { ?>
                temp.push(value.x);
                <?php } elseif ($parm['xtype'] == 'Category') { ?>
                 temp.push(value.name);
                <?php } else { ?>
                 temp.push(value.x);
                <?php } ?>
                            
                           
                        });
                            update_dashboard("<?php echo $parm['link_table']; ?>","<?php echo $parm['target_link']; ?>","=",temp,<?php echo $widget->id; ?>);

    }

    /**
     * On click, unselect all points
     */
    function unselectByClick() {
        var points = this.getSelectedPoints();
        if (points.length > 0) {
            Highcharts.each(points, function (point) {
                point.select(false);
            });
        }
        HighchartsAdapter.fireEvent(this, 'selectedpoints', { points: this.getSelectedPoints() });
    }



$('#w_<?php echo $widget->id; ?>').highcharts({
            chart: {
            type: 'column',
            spacingBottom: 50,
            spacingTop: 50,
            events: {
                selection: selectPointsByDrag,
                selectedpoints: selectedPoints,
                click: unselectByClick
            },
			zoomType: 'xy'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
            }
        },
 title: {
            text: '<?php echo $parm['chart_title']; ?>'
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
                type: 'category',
                <?php } else { ?>
                <?php } ?>
            
        },
        yAxis: {
            title: {
                text: 'Value'
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