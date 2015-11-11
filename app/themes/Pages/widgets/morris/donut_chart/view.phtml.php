<div id="widget_<?php echo $widget->id; ?>" class="<?php echo $parm['width']; ?>" ><?php echo $controls; ?> <h3><?php echo $parm['title']; ?></h3>
 <div id="w_<?php echo $widget->id; ?>" style="width:100% margin: 0"></div>
<script>

dataIn=
Morris.Donut({
  element: 'w_<?php echo $widget->id; ?>',
  data:[
  <?php foreach ($parm['db'] as $row) { ?>
{
     label: '<?php echo $this->escaper->escapeJs($row['label']); ?>',
     value: <?php echo $this->escaper->escapeJs($row['value']); ?>
},
<?php } ?>
]}).on('click', function(i, row){

     update_dashboard("<?php echo $parm['target_link']; ?>", row.label,<?php echo $widget->id; ?>);
});
</script><?php echo $this->getContent(); ?></div>