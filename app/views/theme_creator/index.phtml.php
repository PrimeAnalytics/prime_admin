<?php use Phalcon\Tag; ?>

<?php
 echo $this->getContent(); ?>
   <div class="col-md-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>Themes</strong></h3>
                  <div class="control-btn">
                    <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                    <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                    <i class="icon-settings"></i>
                    </a>
                    <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#">Action</a>
                      </li>
                      <li><a href="#">Another action</a>
                      </li>
                      <li><a href="#">Something else here</a>
                      </li>
                    </ul>
                    <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i class="icons-office-58"></i></a>
                    <a href="#" class="panel-maximize hidden"><i class="icon-size-fullscreen"></i></a>
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                    <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                      <button class="btn btn-primary btn-xs btn-small" onClick="create_new('theme_creator')">New Theme</button>
                  </div>
                    
                </div>
                <div class="panel-content">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                      </tr>
                    </thead>
                      <tbody>
                          <?php foreach ($themes as $theme) { ?>
                          <tr>
                              <td>
                                  <?php echo $theme->id ?>
                              </td>
                              <td>
                                  <?php echo $theme->name ?>
                              </td>
                              <td>
                                  <?php echo $this->tag->linkTo(array("theme_creator/edit/" . $theme->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>
                                  <?php echo $this->tag->linkTo(array("theme_creator/delete_layout/" . $theme->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                              </td>
                          </tr>
                          <?php } ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal">
        <div id="modal_content"></div>
    </div>
    <!-- /.modal-dialog -->
</div>

<script>

            function create_new(datatype)
            {
                $("#modal_content").load("/"+datatype+"/new", function () {
                    $("#myModal").modal("show");
                });
            }


</script>





