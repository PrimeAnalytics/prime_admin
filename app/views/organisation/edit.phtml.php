<?php echo $this->getContent(); ?>
<ul class="breadcrumb">
    <li>
        <p>YOU ARE HERE</p>
    </li>
    <li>
        <a href="/organisation/index" class="active">Edit Organisation</a>
    </li>
</ul>

<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header panel-controls">
            <h3>Organisation  <strong>Settings</strong></h3>
        </div>
        <div class="panel-content">
            <ul class="nav nav-tabs nav-primary">
                <li class=""><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Basic Information</a></li>
                <li class="active"><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Database Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="tab2_1">
                    <?php echo $this->tag->form(array("organisation/save")) ?>
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
                                    <label class="form-label">Organisation name</label>
                                    <span class="help">e.g. "Prime Analytics"</span>
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
                <div class="tab-pane fade active in" id="tab2_2">
                    <?php echo $this->tag->form("database/save") ?>
                    <div class="row column-seperation">

                        <div class="col-md-4" style="min-height:500px;">
                            <h3>
                                <span class="semi-bold">Database</span> Settings
                            </h3>
                        </div>
                        <div class="col-md-8">
                            <div class="grid-body no-border">
                                <br>

                                <div class="form-group">
                                    <label class="form-label">Database Host</label>
                                    <span class="help">e.g. "localhost"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_host", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Database Username</label>
                                    <span class="help">e.g. "root"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_username", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Database Password</label>
                                    <span class="help">e.g. "root"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_password", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Database Name</label>
                                    <span class="help">e.g. "prime_analytics_db"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_name", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Organisation Theme</label>
                                    <div class="">
                                        <select class="form-control" name="theme">
                                            <?php
                        foreach($themeList as $subfile)
                        {
                        $type= strtolower(str_replace(" ","_",$subfile)) ;
                        echo '<option value="'.$type.'" >'.$subfile.'</option>';
                        }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                

                                    <?php echo $this->tag->hiddenField("organisation_id") ?>
                                    <?php echo $this->tag->hiddenField("db_id") ?>
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
                        <th>Title</th>
                        <th>Icon</th>
                        <th>Weight</th>
                        <th style="width:20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dashboards as $dashboard) { ?>
                    <tr>
                        <td>
                            <?php echo $dashboard->title ?>
                        </td>
                        <td>
                            <?php echo $dashboard->icon ?>
                        </td>
                        <td>
                            <?php echo $dashboard->weight ?>
                        </td>
                        <td>
                            <?php echo $this->tag->linkTo(array("dashboards/".$dashboard->type."/edit/" . $dashboard->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>
                            <?php echo $this->tag->linkTo(array("dashboard/delete/" . $dashboard->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
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
            <h3><i class="fa fa-table"></i> <strong>Analytics</strong> Processes</h3>
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
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('process')">Add Process</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>XML</th>
                        <th style="width:30%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($processes as $process) { ?>
                    <tr>
                        <td>
                            <?php echo $process->id ?>
                        </td>
                        <td>
                            <?php echo $process->name ?>
                        </td>

                        <td>
                            <button class="btn btn-primary btn-xs btn-small" onClick="editXml('<?php echo $process->id ?>')">Edit XML</button>
                        </td>

                        <td>
                            <?php echo $this->tag->linkTo(array("process/viewxml/" . $process->id, "View XML",'class'=>"btn btn-success btn-xs btn-small")); ?>

                            <?php echo $this->tag->linkTo(array("process/edit/" . $process->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>

                            <?php echo $this->tag->linkTo(array("users/delete/" . $process->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
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
            <h3><i class="fa fa-table"></i> <strong>Data</strong> Links</h3>
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
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('links')">Add Link</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Table</th>
                        <th>Column</th>
                        <th>Operator</th>
                        <th style="width:15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($links as $link) { ?>
                    <tr>
                        <td>
                            <?php echo $link->id ?>
                        </td>
                        <td>
                            <?php echo $link->name ?>
                        </td>
                        <td>
                            <?php echo $link->table ?>
                        </td>
                        <td>
                            <?php echo $link->column ?>
                        </td>
                        <td>
                            <?php echo $link->operator ?>
                        </td>

                        <td>
                            <?php echo $this->tag->linkTo(array("process/edit/" . $process->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>

                            <?php echo $this->tag->linkTo(array("users/delete/" . $process->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
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
            <h3><i class="fa fa-table"></i> <strong>Virtual</strong> Machines</h3>
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
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('virtual_machine')">Add VM</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>ip</th>
                        <th style="width:30%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($virtual_machines as $virtual_machine) { ?>
                    <tr>
                        <td>
                            <?php echo $virtual_machine->id ?>
                        </td>
                        <td>
                            <?php echo $virtual_machine->name ?>
                        </td>
                        <td>
                            <?php echo $virtual_machine->external_id ?>
                        </td>

                        <td>
                            <?php echo $this->tag->linkTo(array("virtual_machine/state/" . $virtual_machine->id, "Change State",'class'=>"btn btn-success btn-xs btn-small")); ?>

                            <?php echo $this->tag->linkTo(array("virtual_machine/edit/" . $virtual_machine->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>

                            <?php echo $this->tag->linkTo(array("virtual_machine/delete/" . $virtual_machine->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
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
            <h3><i class="fa fa-table"></i> <strong>Registered</strong> Users</h3>
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
                <button class="btn btn-primary btn-xs btn-small" onClick="create_new('users')">Add User</button>
            </div>
        </div>
        <div class="panel-content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="width:20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                    <tr>
                        <td>
                            <?php echo $user->email ?>
                        </td>
                        <td>
                            <?php echo $user->full_name ?>
                        </td>
                        <td>
                            <?php echo $user->role ?>
                        </td>
                        <td>
                            <?php echo $user->status ?>
                        </td>
                        <td>
                            <?php echo $this->tag->linkTo(array("users/edit/" . $user->email, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>

                            <?php echo $this->tag->linkTo(array("users/delete/" . $user->email, "Delete",'class'=>"btn btn-danger btn-xs btn-small")); ?>
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
        <div class="panel-header panel-controls">
            <h3>Data <strong>Connectors</strong></h3>
        </div>
        <div class="panel-content">
            <ul class="nav nav-tabs nav-primary">
                <li class="width-16p active">
                    <a href="#connectors" data-toggle="tab">
                        <span class="text-center">Connectors</span>
                    </a>
                </li>
   <?php
                $directory = '../app/data_connectors/';
                //get all files in specified directory
                $files = glob($directory . "*", GLOB_BRACE);
                //print each file name
                foreach($files as $file)
                {
                //check to see if the file is a folder/directory
                if(is_dir($file))
                {
                echo '
                <li class="width-16p"><a href="#'.basename($file).'" data-toggle="tab"><span class="text-center">'.ucwords (basename($file)).'</span></a></li>';
                }
                }
                ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="connectors">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th style="width:30%">Authentication</th>
                                <th style="width:20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_connectors as $data_connector) { ?>
                            <tr>
                                <td>
                                    <?php echo $data_connector->id ?>
                                </td>
                                <td>
                                    <?php echo $data_connector->name ?>
                                </td>
                                <td>
                                    <?php echo $data_connector->type ?>
                                </td>
                                <td>

                                    <button class="btn btn-primary btn-xs btn-small" onClick="new_modal('<?php echo "/data_connectors/".$data_connector->type."/refreshToken/". $data_connector->id ?>')">Refresh Token</button>
                                    <button class="btn btn-white btn-xs btn-small" onClick="new_modal('<?php echo "/data_connectors/".$data_connector->type."/getToken/". $data_connector->id ?>')">Get Token</button>

                                </td>
                                <td>
                                    <button class="btn btn-success btn-xs btn-small" onClick="edit_connector('<?php echo '/data_connectors/'.$data_connector->type.'/new/'. $data_connector->organisation_id.'/'. $data_connector->id ?>')">Edit</button>

                                    <?php echo $this->tag->linkTo(array("/data_connectors/".$data_connector->type."/delete/" . $data_connector->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")) ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
   <?php
                //path to directory to scan
                $directory = '../app/data_connectors/';
                //get all files in specified directory
                $files = glob($directory . "*", GLOB_BRACE);
                //print each file name
                foreach($files as $file)
                {
                //check to see if the file is a folder/directory
                if(is_dir($file))
                {
                echo '<div class="tab-pane fade" id="'.basename($file).'">
                    ';
                    $subdirectory = '../app/data_connectors/'.basename($file).'/';
                    //get all files in specified directory
                    $subfiles = glob($subdirectory."*.{php}", GLOB_BRACE);
                    foreach($subfiles as $subfile)
                    {
                    $type = str_replace("Controller.php","",basename($subfile));
                    $name = trim(implode(' ', preg_split('/(?=\p{Lu})/u', $type)));
                    $type= "data_connectors/".basename($file)."/".strtolower(str_replace(" ","_",$name)) ;
                    echo '<div class="alert bg-primary">
                        <div data-type="'.$type.'" class="Data_Connector heading" onClick="create_new(\''.$type.'\')">'.$name.'</div>
                    </div>';
                    }
                    echo '
                </div>';
                }
                }
                ?>
            </div>
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
                $("#modal_content").load("/"+datatype+"/new/<?php echo $organisation_id ?>", function () {
                    $("#myModal").modal("show");
                });
            }

            function edit_connector(link)
            {
                $("#modal_content").load(link, function () {
                    $("#myModal").modal("show");
                });
            }

            function new_modal(link)
            {

                window.open(link);
                return false;

            }




</script>

<script>

    function editXml(id) {
        DesktopClient.AnalyticsGui(id);
    }
</script>


