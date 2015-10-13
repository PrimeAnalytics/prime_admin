<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <form method="post" action="<?php echo $form_type; ?>">
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New <?php echo $type; ?>.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
<?php echo $form_body; ?>
    </div>
    <div class="modal-footer bg-blue">   
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>
</div>