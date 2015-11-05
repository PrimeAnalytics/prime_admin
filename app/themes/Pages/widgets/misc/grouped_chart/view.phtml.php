<div id="w_<?php echo $widget->id; ?>" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div><?php

    $dataOut=array();
    foreach($parm['db'] as $row)
    {
        $dataOut[$row['grouping']][]=array("x_axis"=>$row['x_axis'],"value"=>$row['y_axis']);
    }

?>

<script>
$('#w_<?php echo $widget->id; ?>').highcharts({
            chart: {
            type: '<?php echo $parm['chart_type']; ?>',
            spacingBottom: 50,
            spacingTop: 50,
            spacingLeft: 50,
            spacingRight: 50,
			zoomType: 'xy'
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
<?php foreach ($dataOut as $key => $series) { ?>
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
</script><?php echo $this->getContent(); ?>