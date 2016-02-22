<div id="widget_<?php echo $widget->id; ?>"  ><?php echo $controls; ?><div id="w_<?php echo $widget->id; ?>" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div><?php

    $dataOut=array();
    foreach($parm['db'] as $row)
    {
        $dataOut[$row['grouping']][]=array("x_axis"=>$row['x_axis'],"value"=>$row['y_axis']);
    }

?>

<script>
$('#w_<?php echo $widget->id; ?>').highcharts({
            chart: {
            type: 'scatter',
            spacingTop: 50,
			zoomType: 'xy'
        },
        legend: {
enabled: false
},
 title: {
            text: '<?php echo $parm['chart_title']; ?>'
        },
        		  credits: {
  enabled: false
  },
        xAxis: {
            
                <?php if ($parm['xtype'] == 'Date') { ?>
                type: 'datetime',
                <?php } elseif ($parm['xtype'] == 'Category') { ?>
                type: 'datetime',
                <?php } else { ?>
                <?php } ?>
            
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
            },
             scatter: {
                dataLabels: {
                    enabled: true,
                    style: {
                    fontWeight:'light',
                }
                }
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
</script><?php echo $this->getContent(); ?></div>