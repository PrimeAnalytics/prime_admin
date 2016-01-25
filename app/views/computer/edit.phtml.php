<?php echo $this->getContent(); ?>



<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Basic Information</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab2_1">
                <?php echo $this->tag->form(array("computer/save")) ?>
                <div class="row">
                    <div class="grid-body no-border">
                        <br>

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <span class="help">e.g. "User Pc"</span>
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <?php
 echo $this->tag->selectStatic(array("type", "class" => "form-control",array(
            "server" => "Server",
            "client"   => "Client"
        )))
?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">KEY</label>
              
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <?php echo $this->tag->textField(array("key", "class" => "form-control")) ?>
                            </div>
                        </div>

                        <?php echo $this->tag->hiddenField("organisation_id") ?>

                        <?php echo $this->tag->hiddenField("id") ?>
                        <?php echo $this->tag->hiddenField("data") ?>
                    </div>

                </div>
                <p class="pull-right">
                    <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                    <button type="button" onclick="delete_modal('computer','<?php echo $computer->id; ?>')" class="btn btn-danger btn-cons">Delete</button>
                </p>
                </form>

            </div>
        </div>

    </div>
</div>
