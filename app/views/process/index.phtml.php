<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header">
            <h3><i class="fa fa-table"></i> Analytics <strong>Processes</strong></h3>
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
            </div>
        </div>
        <div class="panel-content">
            <ul class="nav nav-tabs nav-primary">
                <li class=""><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Create/Edit Scheduled Process</a></li>
                <li class="active"><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Create/Edit Realtime Process</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="tab2_1">
                    <div class="row column-seperation">
                        <div class="col-md-4">
                            <h3>Create/Edit Scheduled Process</h3>
                            <p>Scheduled Processes are executed in the background automatically, the are used to synchronize data source or do some type of batch analytics.</p>
                            <div class="grid-body no-border">
                                <button type="button" class="btn btn-success btn-rounded pull-right" onclick="create_new('process_scheduled')">Create New</button>

                            </div>
                        </div>

                        <div class="col-md-8" style="min-height:798px;">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th style="width:30%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($processes_scheduled as $process_scheduled) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $process_scheduled->id; ?>
                                        </td>
                                        <td>
                                            <?php echo $process_scheduled->name; ?>
                                        </td>
                                        <td>
                                            <?php echo $this->tag->linkTo(array('/process_scheduled/edit/' . $process_scheduled->id, 'Edit', 'class' => 'btn btn-success btn-xs btn-small')); ?>

                                            <button class="btn btn-danger btn-xs btn-small" onclick="delete_modal('process_scheduled',<?php echo $process_scheduled->id; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade active in" id="tab2_2">
                    <div class="row column-seperation">
                        <div class="col-md-4">
                            <h3>Create/Edit Realtime Process</h3>
                            <p>Realtime Processes are executed everytime the dashboard is loaded, they are less complex and are link bound.</p>
                            <div class="grid-body no-border">
                                <button type="button" class="btn btn-success btn-rounded pull-right" onclick="create_new('process')">Create New</button>

                            </div>
                        </div>

                        <div class="col-md-8" style="min-height:798px;">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th style="width:30%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($processes as $process) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $process->id; ?>
                                        </td>
                                        <td>
                                            <?php echo $process->name; ?>
                                        </td>
                                        <td>
                                            <?php echo $this->tag->linkTo(array('/process/edit/' . $process->id, 'Edit', 'class' => 'btn btn-success btn-xs btn-small')); ?>

                                            <button class="btn btn-danger btn-xs btn-small" onclick="delete_modal('process',<?php echo $process->id; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
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

    function create_new(dataType) {
        $("#modal_content").load('/' + dataType + '/new', function () {
            $("#myModal").modal("show");
        });
    }
   

           function delete_modal(dataType,id)
            {
                $("#modal_content").load('/form/delete/'+dataType+'/'+id, function () {
                    $("#myModal").modal("show");
                });
            }


</script>


<?php echo $this->getContent() ?>


