<?php echo $this->getContent() ?>

<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header panel-controls">
            <h3><strong>Settings</strong></h3>
        </div>
        <div class="panel-content">
            <ul class="nav nav-tabs nav-primary">
                <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-user"></i> Basic Information</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab2_1">
                    <?php echo $this->tag->form(array("theme_creator/theme_save")) ?>
                    <div class="row column-seperation">
                        <div class="col-md-4" style="min-height:500px;">
                            <h3>
                                <span class="semi-bold">Basic</span> Information
                            </h3>
                        </div>
                        <div class="col-md-8">
                            <div class="grid-body no-border">
                                <br>

                                <div class="form-group">
                                    <label class="form-label">Theme name</label>
                                    <span class="help">e.g. "Make"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
                                    </div>
                                </div>
                                <?php echo $this->tag->hiddenField("id") ?>
                            </div>
                        </div>
                    </div>

                    <p class="pull-right">
                        <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                        <button type="button" class="btn btn-white btn-cons">Cancel</button>
                    </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header">
            <h3><i class="fa fa-table"></i> <strong>Logins</strong></h3>
            <div class="control-btn">
                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="#">Action</a>
                    </li>
                    <li>
                        <a href="#">Another action</a>
                    </li>
                    <li>
                        <a href="#">Something else here</a>
                    </li>
                </ul>
                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i class="icons-office-58"></i></a>
                <a href="#" class="panel-maximize hidden"><i class="icon-size-fullscreen"></i></a>
                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('login')">Add Login</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width:20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logins as $login) { ?>
                    <tr>
                        <td>
                            <?php echo $login->id ?>
                        </td>
                        <td>
                            <?php echo $login->name ?>
                        </td>
                        <td>
                            <?php echo $this->tag->linkTo(array("theme_creator/login_edit/".$login->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>
                            <?php echo $this->tag->linkTo(array("theme_creator/login_delete/".$login->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header">
            <h3><i class="fa fa-table"></i> <strong>Dashboards</strong></h3>
            <div class="control-btn">
                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="#">Action</a>
                    </li>
                    <li>
                        <a href="#">Another action</a>
                    </li>
                    <li>
                        <a href="#">Something else here</a>
                    </li>
                </ul>
                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i class="icons-office-58"></i></a>
                <a href="#" class="panel-maximize hidden"><i class="icon-size-fullscreen"></i></a>
                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('dashboard')">Add Dashboard</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width:20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dashboards as $dashboard) { ?>
                    <tr>
                        <td>
                            <?php echo $dashboard->id ?>
                        </td>
                        <td>
                            <?php echo $dashboard->name ?>
                        </td>
                        <td>
                            <?php echo $this->tag->linkTo(array("theme_creator/dashboard_edit/".$dashboard->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>
                            <?php echo $this->tag->linkTo(array("theme_creator/dashboard_delete/".$dashboard->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header">
            <h3><i class="fa fa-table"></i> <strong>Portlets</strong></h3>
            <div class="control-btn">
                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="#">Action</a>
                    </li>
                    <li>
                        <a href="#">Another action</a>
                    </li>
                    <li>
                        <a href="#">Something else here</a>
                    </li>
                </ul>
                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i class="icons-office-58"></i></a>
                <a href="#" class="panel-maximize hidden"><i class="icon-size-fullscreen"></i></a>
                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('portlet')">Add Portlet</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width:20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($portlets as $portlet) { ?>
                    <tr>
                        <td>
                            <?php echo $portlet->id ?>
                        </td>
                        <td>
                            <?php echo $portlet->name ?>
                        </td>
                        <td>
                            <?php echo $this->tag->linkTo(array("theme_creator/portlet_edit/".$portlet->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>
                            <?php echo $this->tag->linkTo(array("theme_creator/portlet_delete/".$portlet->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header">
            <h3><i class="fa fa-table"></i> <strong>Widgets</strong></h3>
            <div class="control-btn">
                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="#">Action</a>
                    </li>
                    <li>
                        <a href="#">Another action</a>
                    </li>
                    <li>
                        <a href="#">Something else here</a>
                    </li>
                </ul>
                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i class="icons-office-58"></i></a>
                <a href="#" class="panel-maximize hidden"><i class="icon-size-fullscreen"></i></a>
                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('widget')">Add Widget</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width:20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($widgets as $widget) { ?>
                    <tr>
                        <td>
                            <?php echo $widget->id ?>
                        </td>
                        <td>
                            <?php echo $widget->name ?>
                        </td>
                        <td>
                            <?php echo $this->tag->linkTo(array("theme_creator/widget_edit/".$widget->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>
                            <?php echo $this->tag->linkTo(array("theme_creator/widget_delete/".$widget->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal">
        <div id="modal_content"></div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>

            function create_new(datatype)
            {
                $("#modal_content").load("/theme_creator/"+datatype+"_new/<?php echo $theme_id ?>", function () {
                    $("#myModal").modal("show");
                });
            }




</script>
