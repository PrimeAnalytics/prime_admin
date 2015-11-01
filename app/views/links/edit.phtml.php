<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <?php echo $this->tag->form("/links/save") ?>
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New Link.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row form-row">
            <div class="col-md-6">
                <label class="form-label">Link Name</label>
                <?php echo $this->tag->textField(array('name', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Database Table</label>
                <?php echo $this->tag->textField(array('table', 'id' => 'dbTable', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row form-row">
            <div class="col-md-6">
                <label class="form-label">Table Column</label>
                <?php echo $this->tag->textField(array('column', 'id' => 'tableColumn', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Table Operator</label>
                <?php echo $this->tag->textField(array('operator', 'id' => 'operator', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row form-row">
            <div class="col-md-6">
                <label class="form-label">Default Value</label>
                <?php echo $this->tag->textField(array('default_value', 'class' => 'form-control')); ?>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-blue">
        <?php echo $this->tag->hiddenfield('organisation_id'); ?>
        <?php echo $this->tag->hiddenfield('id'); ?>

        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>
</div>

<script>

    $.getJSON("/get/DBTables", function (data) {
        $("#dbTable").select2({
            data: data
        });
    });

    var operatorData = [
{ id: '=', text: '=' },
{ id: '!=', text: '&ne;' },
{ id: '>', text: '>' },
{ id: '>=', text: '&ge;' },
{ id: '<', text: '<' },
{ id: '<=', text: '&le;' },

    ];

    $("#operator").select2({
        data: operatorData
    });

    var columnData = "[]";

    var table = '';

    $("#dbTable").on('change', function (event) {
        table = $("#dbTable").select2('val');

        $.getJSON("/get/autocomplete/columns/" + table, function (data) {
            columnData = data;

            $("#tableColumn").autocomplete({
                source: columnData
            });
        });
    });

    $(document).ready(function () {

        var table = $("#dbTable").val();
        var column = $("#tableColumn").val();
        
        $("#dbTable").val('').trigger('change');

    });

</script>