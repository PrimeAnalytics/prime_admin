<div id="w_<?php echo $widget->id; ?>"></div><script>
$('#w_<?php echo $widget->id; ?>').highcharts({
title: {
    text: '<?php echo $parm['title']; ?>'
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