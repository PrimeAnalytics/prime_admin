<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <?php echo $this->tag->form("/variables/save") ?>
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New Global Variable.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Variable Name</label>
                <?php echo $this->tag->textField(array('name', 'class' => 'form-control')); ?>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label">Variables</label>
                    <div><textarea name="values" id="tableColumn" class="form-control" style="width:100%"></textarea></div>
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


    var columnData = "[]";

        $.getJSON("/get/autocomplete/columns/", function (data) {
            columnData = data;

            $("#tableColumn").autocomplete({
                source: columnData
            });
        });




        var columnData = "[]";

        var table = '';

            var request = $.ajax({
                url: "/get/autocomplete/columns/",
                type: "get",
                success: function (result) {

                    data_temp=$("#columnsInput").val();

                    $("#tableColumn").parent().empty().html('<textarea name="values" id="tableColumn" class="form-control" style="width:100%"></textarea>');
                    $("#tableColumn").val(data_temp);
                    $("#tableColumn").tagEditor({
                        delimiter: ',',
                        forceLowercase:false,
                        placeholder: 'Add Parameters ...',
                        maxLength:500,
                        autocomplete: { source: JSON.parse(result,true), minLength: 1, delay: 0, html: true, position: { collision: 'flip' } }
                    });
                
                },
                error:function (result) {

                }
            });


      







    $(document).ready(function () {

        var column = $("#tableColumn").val();

    });

</script>