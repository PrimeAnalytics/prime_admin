<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <form method="post" action="/<?php echo $type; ?>/delete">
        <div class="modal-header">
            <h4 id="myModalLabel" class="semi-bold">Delete <?php echo $type; ?>.</h4>
            <p class="no-margin">Are You sure You want to delete this? </p>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer bg-blue">
            <?php echo $this->tag->hiddenField(array('id')); ?>
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <?php echo $this->tag->submitButton(array("Delete","class"=>"btn btn-dark")) ?>
        </div>
    </form>
</div>