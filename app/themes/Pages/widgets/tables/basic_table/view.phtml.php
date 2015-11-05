<div id="widget_<?php echo $widget->id; ?>"class="col-md-<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
                    <style>
table tr.highlighted {
  background-color:#999;
}
</style>
<div class="pull-right">
                  <div class="col-xs-12">
                    <input type="text" id="search-table<?php echo $widget->id; ?>" class="form-control pull-right" placeholder="Search">
</div> 
                </div>
<table id="w_<?php echo $widget->id; ?>" class="table table-hover table-condensed">
<thead><tr>
                    <?php foreach ($parm['db'][0]['series'] as $key => $item) { ?>
                    <th><?php echo $key; ?> </th>
                    <?php } ?>
                          </tr></thead>
<tbody>
                          
                             <?php foreach ($parm['db'] as $row) { ?>
                             <tr>
        <?php foreach ($row['series'] as $item) { ?>
<td class="v-align-middle"><?php echo $item; ?> </td>
        <?php } ?>
</tr>
<?php } ?>
                        </tbody>
</table>   <script>
   var initTableWithSearch = function() {
        var table = $('#w_<?php echo $widget->id; ?>');
        
        
        
            var isMouseDown = false,
    isHighlighted;
    $('#w_<?php echo $widget->id; ?> tbody tr').mousedown(function () {
      isMouseDown = true;
      $(this).toggleClass("highlighted");
      isHighlighted = $(this).hasClass("highlighted");
      return false; // prevent text selection
    })
    .mouseover(function () {
      if (isMouseDown) {
        $(this).toggleClass("highlighted", isHighlighted);
      }
    })
    .bind("selectstart", function () {
      return false;
    })

  $(document)
    .mouseup(function () {
      isMouseDown = false;
    });
        
        
        
        
        
        
        
        
        
        

        var settings = {
            "sDom": "<'table-responsive't><'row'<p i>>",
            "sPaginationType": "bootstrap",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 5
        };

        table.dataTable(settings);

        // search box for table
        $('#search-table<?php echo $widget->id; ?>').keyup(function() {
            table.fnFilter($(this).val());
        });
    }
    
    initTableWithSearch();
    
    
    
    
    </script><?php echo $this->getContent(); ?></div>