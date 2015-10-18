<div id="w_<?php echo $widget->id; ?>"></div><script>
$('#w_<?php echo $widget->id; ?>').highcharts({
title: {
    text: '<?php echo $parm['title']; ?>'
},
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
        data: [<?php foreach ($parm['db'] as $row) { ?>
    <?php echo $row['x_axis']; ?> ,
<?php } ?>]
    }]

});
</script><?php echo $this->getContent(); ?>