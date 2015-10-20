
<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <form method="post" action="<?php echo $form_type; ?>">
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New <?php echo $type; ?>.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row form-row">
            <div class="col-md-6">
                <label class="form-label">Dashboard Name</label>
                <?php echo $this->tag->textField(array("title", "class" => "form-control")) ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Icon</label>
                <div class="input-group">
                    <input data-placement="bottomRight" class="form-control icp icp-auto" value="fa-archive" type="text" name="icon" />
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>
<?php echo $form_body; ?>
    </div>
    <div class="modal-footer bg-blue">   
        <?php echo $this->tag->hiddenfield('organisation_id'); ?>
        <?php echo $this->tag->hiddenfield('weight'); ?>
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>
</div>

<script>
    $(function() {
    $('.icp-auto').iconpicker();
    });

</script>