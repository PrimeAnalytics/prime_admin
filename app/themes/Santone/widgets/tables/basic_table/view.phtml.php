<div id="widget_<?php echo $widget->id; ?>" class="<?php echo $parm['width']; ?>" ><?php echo $controls; ?>
<table id="w_<?php echo $widget->id; ?>" class="table table-hover">
                        <thead>
                          <tr>
                              <?php if (($this->length($parm['db']) != 0)) { ?>
                              
                    <?php foreach ($parm['db'][0]['series'] as $key => $item) { ?>
                    <th><?php echo $key; ?> </th>
                    <?php } ?>
                    <?php } ?>
                          </tr>
                        </thead>
                        <tbody>
                          
                             <?php foreach ($parm['db'] as $row) { ?>
                             <tr>
        <?php foreach ($row['series'] as $item) { ?>
<td class="v-align-middle"><?php echo $item; ?> </td>
        <?php } ?>
</tr>
<?php } ?>
                        </tbody>
                      </table>
                         <script>
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
            "scrollX": true,
            "responsive": true,
            "scrollCollapse": true,
            "paging":         true,
                    "oTableTools": {
            "sRowSelect": "multi",
            "aButtons" : []
        }
        };
        


    table.dataTable(settings);
        

         $('#w_<?php echo $widget->id; ?> tbody').on( 'click', 'tr', function () {
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