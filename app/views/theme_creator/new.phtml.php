
<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <?php echo $this->tag->form("theme_creator/create") ?>
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New Theme.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row form-row">
            <div class="col-md-6">
                <label class="form-label">Theme Name</label>
                <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-blue">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>
</div>
