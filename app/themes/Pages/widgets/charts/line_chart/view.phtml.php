<div id="w_<?php echo $widget->id; ?>" style="width:100%"></div><script>
$('#w_<?php echo $widget->id; ?>').highcharts({
            chart: {
            type: '<?php echo $parm['chart_type']; ?>',
            zoomType: 'xy'
        },
 title: {
            text: '<?php echo $parm['chart_title']; ?>',
            x: -20 //center
        },
        xAxis: {
            title: {
                text: '<?php echo $parm['x_label']; ?>'
            }
        },
        yAxis: {
            title: {
                text: '<?php echo $parm['y_label']; ?>'
            }
        },
 series: [
<?php foreach ($parm['db'] as $key => $series) { ?>
{
     name: '<?php echo $this->escaper->escapeJs($key); ?>',
     data: [
        <?php foreach ($series as $row) { ?>
    ['<?php echo $this->escaper->escapeJs($row['x_axis']); ?>',<?php echo $this->escaper->escapeJs($row['value']); ?>] ,
        <?php } ?>
]},

<?php } ?>
]

});
</script><?php echo $this->getContent(); ?>