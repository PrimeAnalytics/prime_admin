<?php echo $this->getContent(); ?>



<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Basic Information</a></li>
            <li class=""><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Dashboards</a></li>
            <li class=""><a href="#tab2_3" data-toggle="tab"><i class="icon-user"></i> Processes</a></li>
            <li class=""><a href="#tab2_4" data-toggle="tab"><i class="icon-user"></i> Scheduled Processes</a></li>
            <li class=""><a href="#tab2_5" data-toggle="tab"><i class="icon-user"></i> Database Tables</a></li>
            <li class=""><a href="#tab2_6" data-toggle="tab"><i class="icon-user"></i> Users</a></li>
            <li class=""><a href="#tab2_7" data-toggle="tab"><i class="icon-user"></i> Global Variables</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab2_1">
                <?php echo $this->tag->form(array("security_group/save")) ?>
                <div class="row">
                    <div class="grid-body no-border">
                        <br>

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <span class="help">e.g. "General Management"</span>
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <span class="help">e.g. "Security Group For General Management"</span>
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <?php echo $this->tag->textField(array("description", "class" => "form-control")) ?>
                            </div>
                        </div>

                      

                        <?php echo $this->tag->hiddenField("organisation_id") ?>

                        <?php echo $this->tag->hiddenField("id") ?>
                    </div>

                </div>
                <p class="pull-right">
                    <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                    <button type="button" onclick="delete_modal('security_group','<?php echo $security_group; ?>')" class="btn btn-danger btn-cons">Delete</button>
                </p>
                </form>

            </div>
            <div class="tab-pane fade " id="tab2_2">
                <h3>Security Group's <strong>Dashboards</strong></h3>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th style="width:30%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         foreach ($dashboard_read as $dashboard) {
?>
                        <tr>
                            <td>
                                <?php echo $dashboard->id ?>
                            </td>
                            <td>
                                <?php echo $dashboard->title ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/dashboard/write/" . $dashboard->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/dashboard/disable/" . $dashboard->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php
                         foreach ($dashboard_write as $dashboard) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $dashboard->id ?>
                            </td>
                            <td>
                                <?php echo $dashboard->title ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/dashboard/read/" . $dashboard->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/dashboard/disable/" . $dashboard->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php
                         foreach ($dashboard_disable as $dashboard) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $dashboard->id ?>
                            </td>
                            <td>
                                <?php echo $dashboard->title ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/dashboard/write/" . $dashboard->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/dashboard/read/" . $dashboard->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>


                    </tbody>

                </table>
            </div>
            <div class="tab-pane fade " id="tab2_3">
                <h3>Security Group's <strong>Processes</strong></h3>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th style="width:30%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($process_write as $process) { ?>
                        <tr>
                            <td>
                                <?php echo $process->id ?>
                            </td>
                            <td>
                                <?php echo $process->name ?>
                            </td>
                            <td>
                            <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process/read/" . $process->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process/disable/" . $process->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($process_read as $process) { ?>
                        <tr>
                            <td>
                                <?php echo $process->id ?>
                            </td>
                            <td>
                                <?php echo $process->name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process/write/" . $process->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process/disable/" . $process->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($process_disable as $process) { ?>
                        <tr>
                            <td>
                                <?php echo $process->id ?>
                            </td>
                            <td>
                                <?php echo $process->name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process/write/" . $process->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process/read/" . $process->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>


                    </tbody>

                </table>
            </div>
            <div class="tab-pane fade " id="tab2_4">
                <h3>Security Group's <strong>Scheduled Processes</strong></h3>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="width:30%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($process_scheduled_write as $process_scheduled) { ?>
                        <tr>
                            <td>
                                <?php echo $process_scheduled->id ?>
                            </td>
                            <td>
                                <?php echo $process_scheduled->name ?>
                            </td>
                            <td>
                                <?php echo $process_scheduled->description ?>
                            </td>
                            <td>
                            <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process_scheduled/read/" . $process_scheduled->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process_scheduled/disable/" . $process_scheduled->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($process_scheduled_read as $process_scheduled) { ?>
                        <tr>
                            <td>
                                <?php echo $process_scheduled->id ?>
                            </td>
                            <td>
                                <?php echo $process_scheduled->name ?>
                            </td>
                            <td>
                                <?php echo $process_scheduled->description ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process_scheduled/write/" . $process_scheduled->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process_scheduled/disable/" . $process_scheduled->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($process_scheduled_disable as $process_scheduled) { ?>
                        <tr>
                            <td>
                                <?php echo $process_scheduled->id ?>
                            </td>
                            <td>
                                <?php echo $process_scheduled->name ?>
                            </td>
                            <td>
                                <?php echo $process_scheduled->description ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process_scheduled/write/" .$process_scheduled->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/process_scheduled/read/" . $process_scheduled->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>

                      

                    </tbody>

                </table>
            </div>
            <div class="tab-pane fade " id="tab2_5">
                <h3>Security Group's <strong>Database Tables</strong></h3>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th style="width:30%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($org_database_table_write as $org_database_table) { ?>
                        <tr>
                            <td>
                                <?php echo $org_database_table->id ?>
                            </td>
                            <td>
                                <?php echo $org_database_table->name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/org_database_table/read/" . $org_database_table->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/org_database_table/disable/" . $org_database_table->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php foreach ($org_database_table_read as $org_database_table) { ?>
                        <tr>
                            <td>
                                <?php echo $org_database_table->id ?>
                            </td>
                            <td>
                                <?php echo $org_database_table->name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/org_database_table/write/" . $org_database_table->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/org_database_table/disable/" . $org_database_table->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php foreach ($org_database_table_disable as $org_database_table) { ?>
                        <tr>
                            <td>
                                <?php echo $org_database_table->id ?>
                            </td>
                            <td>
                                <?php echo $org_database_table->name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/org_database_table/write/" . $org_database_table->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/org_database_table/read/" . $org_database_table->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>


                    

                    </tbody>

                </table>
            </div>
            <div class="tab-pane fade " id="tab2_6">
                <h3>Security Group's <strong>Users</strong></h3>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th style="width:30%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users_write as $user) { ?>
                        <tr>
                            <td>
                                <?php echo $user->email ?>
                            </td>
                            <td>
                                <?php echo $user->full_name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/users/read/" . $user->email, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/users/disable/" . $user->email, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($users_read as $user) { ?>
                        <tr>
                            <td>
                                <?php echo $user->email ?>
                            </td>
                            <td>
                                <?php echo $user->full_name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/users/write/" . $user->email, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/users/disable/" . $user->email, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($users_disable as $user) { ?>
                        <tr>
                            <td>
                                <?php echo $user->email ?>
                            </td>
                            <td>
                                <?php echo $user->full_name ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/users/write/" . $user->email, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/users/read/" . $user->email, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>


                    </tbody>

                </table>
            </div>
            <div class="tab-pane fade " id="tab2_7">
                <h3>Security Group's <strong>Variables</strong></h3>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th style="width:30%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($variables_write as $variable) { ?>
                        <tr>
                            <td>
                                <?php echo $variable->id ?>
                            </td>
                            <td>
                                <?php echo $variable->name ?>
                            </td>
                            <td>
                                <?php echo $variable->value ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/variable/read/" . $variable->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/variable/disable/" . $variable->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($variables_read as $variable) { ?>
                        <tr>
                            <td>
                                <?php echo $variable->id ?>
                            </td>
                            <td>
                                <?php echo $variable->name ?>
                            </td>
                            <td>
                                <?php echo $variable->value ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/variable/write/" . $variable->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/variable/disable/" . $variable->id, "Disable",'class'=>"btn btn-default btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($variables_disable as $variable) { ?>
                        <tr>
                            <td>
                                <?php echo $variable->id ?>
                            </td>
                            <td>
                                <?php echo $variable->name ?>
                            </td>
                            <td>
                                <?php echo $variable->value ?>
                            </td>
                            <td>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/variable/write/" . $variable->id, "Read/Write",'class'=>"btn btn-danger btn-xs btn-small")); ?>
                                <?php echo $this->tag->linkTo(array("security_group/set/".$security_group."/variable/read/" . $variable->id, "Read",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                            </td>
                        </tr>
                        <?php } ?>

                     

                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
