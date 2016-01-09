
<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <?php echo $this->tag->form("security_group/create") ?>
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New Security Group.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row form-row">
            <div class="col-md-6 form-group">
                <label class="form-label">Security Group Name</label>
                <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
            </div>

        </div>

        <div class="row form-row">
            <div class="col-md-12 form-group">
                <label class="form-label">Description</label>
                <?php echo $this->tag->textArea(array("description", "class" => "form-control")) ?>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-blue">
        <?php echo $this->tag->hiddenField("organisation_id") ?>
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>


</div>
