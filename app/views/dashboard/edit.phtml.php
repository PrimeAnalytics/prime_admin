<?php echo $this->getContent(); ?>

    <script>
    var links =<?php echo json_encode($links)?>;
    </script>



    <div class="page-content page-builder">
        <div id="hidden-small-screen-message">
            <h2 class="m-t-40"><strong>Page Builder</strong> is not available on small screen</h2>
            <p>Editor is not adapted to screen smaller than 1024px.</p>
            <p>For that reason, page builder is only visible on screen bigger.</p>
        </div>
        <div id="page-builder" class="bg-primary">
            <div class="tabs tabs-linetriangle">
                <ul class="nav nav-tabs">
                    <li class="width-16p active">
                        <a href="#layout" data-toggle="tab">
                            <span class="text-center">Layout</span>
                        </a>
                    </li>

                    <?php
                foreach($widgetList as $key=>$value)
                {
              echo '<li class="width-16p"><a href="#'.$key.'" data-toggle="tab"><span class="text-center">'.$key.'</span></a></li>';
              }
                    ?>
                </ul>
                <div class="tab-content clearfix" style="overflow:visible">
                    <div class="tab-pane fade in active" id="layout">
                        <?php
                    foreach($portletList as $subfile)
                    {
                    $type= "c_".strtolower(str_replace(" ","_",$subfile)) ;
                    echo '<div data-type="'.$type.'" class="layout ui-draggable">'.$subfile.'</div>';
                    }
                        ?>
                    </div>
                    <?php
                foreach($widgetList as $key=>$subfiles)
                {
                  echo '<div class="tab-pane fade" id="'.$key.'">';
                foreach($subfiles as $subfile)
                {
                     $type= "w_".strtolower($key)."/".strtolower(str_replace(" ","_",$subfile)) ;
                echo '<div data-type="'.$type.'" class="layout ui-draggable">'.$subfile.'</div>';
                }
                echo '</div>';
                }
                    ?>

                    <script>

              function update_dropzone(){
              contents = $("#dashboard_iframe").contents();

              contents.find('.widget_drag').draggable({
              iframeFix: true,
              handle: ".draghandle",
              appendTo: 'body',
              zIndex: 100,
              helper: "clone"
              });

              contents.find('.dropzone-portlet').droppable({
                  iframeFix: true,

              activeClass: 'active',
              hoverClass: 'hover',
              tolerance: "pointer",
              accept: ":not(.ui-sortable-helper)", // Reject clones generated by sortable
              drop: function (e, ui) {

              var draggable = ui.draggable;
              var datatype = draggable.attr("data-type");


              var portletId = $(this).attr("data-portlet-id");
              var rowNumber = $(this).attr("data-row");
              var columnNumber = $(this).children().length;

              if(datatype.substr(0, 2)=="u_")
              {

              $("#modal_content").load("/widget/move/"+ portletId + "/" + rowNumber + "/" + columnNumber + "/" + draggable.attr("data-widget-id") , function () {
              $("#myModal").modal("show");
              });
              }

              else if(datatype.substr(0, 2)=="w_")
              {
              $("#modal_content").load("/widgets/"+datatype.substring(2)+"/new/"+ portletId + "/" + rowNumber + "/" + columnNumber, function () {
              $("#myModal").modal("show");
              });
              }
              }
              });

              };


              function portlet_edit(id){
              $("#modal_content").load("/portlet/edit/" + id, function () {
              $("#myModal").modal("show");
              })};

              function portlet_delete(id){
              $("#modal_content").load("/portlet/delete/" + id, function () {
              $("#myModal").modal("show");
              })};

              function widget_edit(type,id){
              $("#modal_content").load("/widgets/"+type.trim()+"/edit/" + id, function () {
              $("#myModal").modal("show");
              })};

              function widget_delete(id){
              $("#modal_content").load("/widget/delete/" + id, function () {
              $("#myModal").modal("show");
              })};


                    </script>

                </div>
            </div>
        </div>

        <iframe width="100%" src="/dashboards/<?php echo $dashboard_type ?>/render/<?php echo $dashboard_id ?>/builder/" scrolling="no" id="dashboard_iframe" height="2000px" frameborder="0"></iframe>

    </div> 

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal">
        <div id="modal_content" class="modal-content">

        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div id="context-menu-portlet" class="context-menu dropdown clearfix" style="position: absolute;">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
        <li class="dropdown-title">Menu</li>
        <li class="edit-icon"><a href="#" data-action="edit"><i class="icon-pencil c-gray"></i> Edit Portlet</a></li>
        <li class="remove"><a href="#" data-action="remove"><i class="icon-ban c-gray"></i> Remove</a></li>
    </ul>
</div>

<div id="context-menu-widget" class="context-menu dropdown clearfix" style="position: absolute;">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
        <li class="dropdown-title">Menu</li>
        <li class="edit-icon"><a href="#" data-action="edit"><i class="icon-pencil c-gray"></i> Edit Widget</a></li>
        <li class="remove"><a href="#" data-action="remove"><i class="icon-ban c-gray"></i> Remove</a></li>
    </ul>
</div>
    

<script>

    $(document).ready(function () {


        var dataIn;
        $.getJSON("/widget/getAllTables", function(data){
        $("#link_table_column").select2({
        data:data,
        placeholder: "Select a Linking Column"
        });
        });

        $("#dashboard_iframe").load(function () {
        var $this = $(this);
        var contents = $this.contents();
        // here, catch the droppable div and create a droppable widget

        contents.find('.dropzone-dashboard').droppable({
            iframeFix: true,
            greedy: true,
        activeClass: 'active',
        hoverClass: 'hover',
        tolerance: "pointer",
        accept: ":not(.ui-sortable-helper)", // Reject clones generated by sortable
        drop: function (e, ui) {

        var rowNumber = $(this).attr("id").substring(4);
        var columnNumber = $(this).children().length;

        var draggable = ui.draggable;
        var datatype = draggable.attr("data-type");

        if(datatype.substr(0, 2)=="c_")
        {

            $("#modal_content").load("/portlets/"+datatype.substring(2)+"/new/<?php echo $dashboard_id; ?>/"+rowNumber+"/"+columnNumber , function () {
                $("#myModal").modal("show");
            });
        }
        else
        {
           // alert(datatype);

        }

          }
          });
          });


          $(".ui-draggable").draggable({
          revert: "invalid",
          iframeFix: true,
          appendTo: 'body',
          zIndex: 100,
            helper: function() {
            currentElement = $(this).html();
            return $('<div style="padding:20px;height: 100px; border:1px solid #E6E6E6;border-radius:3px;width: 300px; background: #fff; box-shadow: 3px 3px 2px rgba(0,0,0,0.1); text-align: center; line-height: 30px; font-size: 16px; color: #121212">' + currentElement + '</div>');
            }
          });



   });


   function iframe_load()
    {

       function delete_modal(dataType,id)
       {
           $("#modal_content").load('/form/deletePost/'+id,{type:dataType}, function () {
               $("#myModal").modal("show");
           });
       }

       $('#dashboard_iframe').contents().find(".builder-portlet").mousedown(function(event) {
           
           var w = $(window);
           var offset = $('#dashboard_iframe').offset();
           var iframe_left= (offset.left-w.scrollLeft());
           var iframe_top= (offset.top-w.scrollTop());


           var $contextMenu = $("#context-menu-portlet");
           if(event.which==3)
           {
               $('#context-menu-portlet').show();
               $(this).contextmenu({
                   leftOffset:iframe_left,
                   topOffset:iframe_top,
                   target: '#context-menu-portlet',
                   onItem: function (context, e) {
                       var action = $(e.target).data("action");
                       $element = context;
                       if(action == 'edit'){
                           var type = $element.data("type");
                           var id = $element.data("id");
                           $("#modal_content").load("/portlets/"+type+"/edit/"+id , function () {
                            $("#myModal").modal("show");
                           });
                       }
                       else if(action == 'remove'){
                           var type = $element.data("type");
                           var id = $element.data("id");
                           delete_modal('portlets/'+type,id);
                       }
                   }
               });


           }
       });

       $('#dashboard_iframe').contents().find(".builder-widget").mousedown(function(event) {
           var w = $(window);
           var offset = $('#dashboard_iframe').offset();
           var iframe_left= (offset.left-w.scrollLeft());
           var iframe_top= (offset.top-w.scrollTop());

           var $contextMenu = $("#context-menu");
           if(event.which==3)
           {
               $('#context-menu-widget').show();
               $(this).contextmenu({
                   leftOffset:iframe_left,
                   topOffset:iframe_top,
                   target: '#context-menu-widget',
                   onItem: function (context, e) {
                       var action = $(e.target).data("action");
                       $element = context;
                       if(action == 'edit'){
                           var type = $element.data("type");
                           var id = $element.data("id");
                           $("#modal_content").load("/widgets/"+type+"/edit/"+id , function () {
                               $("#myModal").modal("show");
                           });
                       }
                       else if(action == 'remove'){
                           var type = $element.data("type");
                           var id = $element.data("id");
                           delete_modal('widgets/'+type,id);
                       }
                   }
               });



           }
       });



   }











</script>


    