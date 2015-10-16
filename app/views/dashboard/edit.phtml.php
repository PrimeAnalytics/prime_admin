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
                    <a href="#info" data-toggle="tab">
                        <span class="text-center">Basic Info</span>
                    </a>
                </li>
                <li class="width-16p">
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
                <div class="tab-pane fade in active" id="info">
                    <?php echo $this->tag->form("dashboard/save") ?>
                        <div class="col-md-12">

                                <div class="form-group col-md-3">
                                    <label class="form-label">Title</label>
                                    <span class="help">e.g. "Market Metrics"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("title", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="form-label">Menu Weight</label>
                                    <span class="help">e.g. "Please Select"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("weight", "class" => "form-control")) ?>
                                    </div>
                                </div>


                                <div class="form-group col-md-3">
                                    <label class="form-label">Icon</label>
                                    <span class="help">e.g. "Please Select"</span>
                                    <div class="input-group">
                                        <?php echo $this->tag->textField(array("icon", "class"=>"form-control icp icp-auto","data-placement"=>"bottomRight")) ?>
                                        <span class="input-group-addon"></span>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="form-label">Style</label>
                                    <span class="help">e.g. "Please Select"</span>
                                    <div class="input">

                                        <select class="form-control" name="style">

                        <?php
                        foreach($dashboardList as $subfile)
                        {
                        $type= strtolower(str_replace(" ","_",$subfile)) ;
                        echo '<option value="'.$type.'" >'.$subfile.'</option>';
                        }
                        ?>

                                        </select>
                                    </div>
                                </div>
                            <?php echo $this->tag->hiddenField("organisation_id") ?>
                            <?php echo $this->tag->hiddenField("id") ?>
                        </div>
                    <p class="pull-right">
                        <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                        <button type="button" class="btn btn-white btn-cons">Cancel</button>
                    </p>
                    </form>
                </div>
                <div class="tab-pane fade" id="layout">
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


        var menuContext =   '<div id="context-menu" class="context-menu dropdown clearfix">'+
                          '<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">'+
                           '<li class="dropdown-title">Panel</li>'+
                            '<li class="color-background"><a href="#" data-action="background"><i class="icon-pencil c-gray"></i> Change Background Color</a></li>'+
                            '<li class="edit-icon"><a href="#" data-action="icon"><i class="icon-star c-gray"></i> Edit Icon</a></li>'+
                            '<li class="remove-icon"><a href="#" data-action="remove-icon"><i class="icon-pencil c-gray"></i> Remove Icon</a></li>'+
                            '<li class="remove"><a href="#" data-action="remove"><i class="icon-ban c-gray"></i> Remove</a></li>'+
                          '</ul>'+
                        '</div>';
    $('.page-content').append(menuContext);
    var $contextMenu = $("#context-menu");

    /* Context Menu */
    $('.builder-wrapper').on('mousedown', '.panel-header h3, .panel-footer h3, .panel-content:not(.widget-info), i', function(){
          $('#context-menu .color-background, #context-menu .edit-icon, #context-menu .remove-icon').show();
          if($(this).hasClass('panel-content')){
            $('#context-menu .edit-icon').hide();
            $('#context-menu .remove-icon').hide();
          }
          if(!$(this).find('i').length){
              $('#context-menu .remove-icon').hide();
          }
          if($(this).is('i')){
              if($(this).parent().hasClass('form-sortable-btn')){
                  return;
              }
              $('#context-menu .edit-icon').show();
          }
          $(this).contextmenu({
              target: '#context-menu',
              onItem: function (context, e) {
                  var action = $(e.target).data("action");
                  context.addClass('current-context');
                  if(action == 'background'){
                      $('#modal-background').modal('show');
                  }
                  if(action == 'icon'){
                      $('#modal-icons').modal('show');
                  }
                  if(action == 'remove-icon'){
                      context.find('i').remove();
                  }
                  if(action == 'remove'){
                      $element = context;
                      if($element.hasClass('nav-parent')) $remove_txt = "Are you sure to remove this element?<br>";
                      else if($element.parent().hasClass('panel')) $remove_txt = "Are you sure this panel?";
                      else $remove_txt = "Are you sure to remove this element?";
                      bootbox.confirm($remove_txt, function(result) {
                          if(result === true){
                            $element.addClass("animated bounceOutLeft");
                            window.setTimeout(function () {
                              if($element.parent().hasClass('panel')){
                                  $element.parent().remove();
                              }
                              else{
                                  $element.remove();
                              }

                            }, 300);
                          }
                      });
                  }
              }
          });
    });








</script>


    