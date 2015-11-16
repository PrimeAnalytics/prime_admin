<div id="widget_<?php echo $widget->id; ?>"  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>

<div>
    
    <?php  $max =array();  ?>
    
    <?php foreach ($parm['db'] as $entry) { ?>
    
         <?php  $max[] = $entry['value']; ?>

<?php } ?>
    
    <?php 
    if(max($max)>0) 
    { 
    $max=max($max);
    }
    else
    {
    $max=1;
    }
    ?>
    
    <style>
    
    td {
    position: relative;
}
.rowprogress {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    background-color: green;
     opacity: 0.2;
    z-index: 99;
}
</style>

<table id="w_<?php echo $widget->id; ?>" class="table table-hover">
    <thead>
                          <tr>
                              <th>Please Select </th>
                              </tr>
                        </thead>
    <tbody>
<?php foreach ($parm['db'] as $entry) { ?>
 <tr> 
    <td ><div class="rowprogress" style="width:<?php echo ($entry['value'] * 100) / $max; ?>%"></div> <?php echo $entry['label']; ?> </td>
 </tr>
<?php } ?>
</tbody>
</table>
</div>   <script>
   var initTableWithSearch = function() {
        var table = $('#w_<?php echo $widget->id; ?>');
        
 <?php $linking_column=array(); ?>     
 <?php foreach ($parm['db'] as $row) { ?>
  <?php $linking_column[]=$row['link_column']; ?> 
<?php } ?>
var linking_column=<?php echo json_encode($linking_column) ?> ;

        var settings = {
            "sDom": 'T<"clear">lfrtip',
            "destroy": true,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "scrollY": "400px",
            "scrollX": true,
            "paging":         false,
                    "oTableTools": {
            "sRowSelect": "multi",
            "aButtons" : []
        }
        };
        


    table.dataTable(settings);
        

         $('#w_<?php echo $widget->id; ?>').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
            var oTT = TableTools.fnGetInstance( 'w_<?php echo $widget->id; ?>' );
    var aData = oTT.fnGetSelectedIndexes();
    var link_set=[];
    $.each( aData, function( key, value ) {
    link_set.push(linking_column[value]);
    });
    
    
    
    
     update_dashboard("<?php echo $parm['target_link']; ?>", link_set,<?php echo $widget->id; ?>);
        
    } );
   
    }
    
    initTableWithSearch();
    
    
    
    
    </script><?php echo $this->getContent(); ?></div>