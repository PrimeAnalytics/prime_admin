<div id="widget_<?php echo $widget->id; ?>" class="panel-content pagination2 table-responsive <?php echo $parm['width']; ?> "  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
<div class="panel-content pagination2 table-responsive">
<table id="w_<?php echo $widget->id; ?>" class="table table-hover table-dynamic">
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
                      
                      </div>
                         <script>
   var initTableWithSearch = function() {
        var table = $('#w_<?php echo $widget->id; ?>');
        
 <?php $linking_column=array(); ?>     
 <?php foreach ($parm['db'] as $row) { ?>
  <?php $linking_column[]=reset($row['series']); ?> 
<?php } ?>
var linking_column=<?php echo json_encode($linking_column) ?> ;

        var settings = {
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "scrollX": true,
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
   

        // search box for table
        $('#search-table<?php echo $widget->id; ?>').keyup(function() {
            table.fnFilter($(this).val());
        });
    }
    
    initTableWithSearch();
    
    
    
    
    </script><?php echo $this->getContent(); ?></div>