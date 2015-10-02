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
                    foreach($canvasList as $subfile)
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

              contents.find('.dropzone-canvas').droppable({
              iframeFix: true,
              activeClass: 'active',
              hoverClass: 'hover',
              tolerance: "pointer",
              accept: ":not(.ui-sortable-helper)", // Reject clones generated by sortable
              drop: function (e, ui) {

              var draggable = ui.draggable;
              var datatype = draggable.attr("data-type");


              var canvasId = $(this).attr("data-canvasId");
              var rowNumber = $(this).attr("data-canvasRowNumber");
              var columnNumber = $(this).children().length;

              if(datatype.substr(0, 2)=="u_")
              {

              $("#modal_content").load("/widget/move/"+ canvasId + "/" + rowNumber + "/" + columnNumber + "/" + draggable.attr("data-widget_id") , function () {
              $("#myModal").modal("show");
              });
              }

              else if(datatype.substr(0, 2)=="w_")
              {
              $("#modal_content").load("/widgets/"+datatype.substring(2)+"/new/"+ canvasId + "/" + rowNumber + "/" + columnNumber, function () {
              $("#myModal").modal("show");
              });
              }
              }
              });

              };


              function canvas_edit(id){
              $("#modal_content").load("/canvas/edit/" + id, function () {
              $("#myModal").modal("show");
              })};

              function canvas_delete(id){
              $("#modal_content").load("/canvas/delete/" + id, function () {
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

    <iframe width="100%" src="/dashboard/render/<?php echo $dashboard_id ?>/builder/" scrolling="no" id="dashboard_iframe" height="200px" frameborder="0"></iframe>

</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal">
        <div id="modal_content"></div>
    </div>
    <!-- /.modal-dialog -->
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

        contents.find('.dropzone-row').droppable({
        iframeFix: true,
        activeClass: 'active', greedy: true,
        hoverClass: 'hover',
        tolerance: "pointer",
        accept: ":not(.ui-sortable-helper)", // Reject clones generated by sortable
        drop: function (e, ui) {

        var rowNumber = $(this).attr("data-rowNumber");
        var columnNumber = $(this).children().length;

        var draggable = ui.draggable;
        var datatype = draggable.attr("data-type");

        switch (datatype) {
        case "canvas":
        $("#modal_content").load("/Canvas/new/<?php echo $dashboard_id ?>" + "/" + rowNumber + "/" + columnNumber, function () {
          $("#myModal").modal("show");
          });
          break;
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


</script>


    