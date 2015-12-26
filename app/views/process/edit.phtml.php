<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-content">

                    <div class="row">
                        <section class="app">
                            <aside class="aside-sm emails-list">
                                <section>
                                    <h1><strong>Edit </strong>Process</h1>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active">
                                            <div class=" form-group">
                                                <label>Table:</label>
                                                <input id="dbTable" class="form-control" data-search="true">
                                                </input>
                                            </div>
                                            <div class=" form-group">
                                                <label>Order By:</label>
                                                <div>
                                                    <input id="orderbyInput" class="form-control" data-search="true">
                                                    </input>
                                                </div>
                                                
                                            </div>
                                            <div class=" form-group">
                                                <input type="checkbox" id="descending" value="DESC">Descending</input>
                                            </div>
                                            <div class=" form-group">
                                                <label>Limit:</label>
                                                <div>
                                                    <input id="limitInput" class="form-control" data-search="true">
                                                    </input>
                                                </div>

                                            </div>

                                                <div id="tableColumns" style="overflow:hidden">

                                                </div>
                                            </div>
                                    </div>
                                </section>
                            </aside>
                            <div class="email-details">
                                <section>
                                    <div class="email-subject">
                                        <div class="pos-rel pull-right">
                                            <button id="getResult" class="btn btn-sm btn-primary btn-rounded">Get Results</button>
                                            <button id="save" class="btn btn-sm btn-warning btn-rounded">Save</button>
                                        </div>
                                        <table style="width:100%; border:hidden" class="table table-hover">
                                            <tr><td style="width:100px"><label>Rows:</label></td><td><textarea id="rowsInput" class="form-control" style="width:100%"></textarea></td></tr>
                                            <tr><td style="width:100px"><label>Columns:</label></td><td><textarea id="columnsInput" class="form-control" style="width:100%"></textarea></td></tr>
                                            </table>
                                        
                                        
                                        <div class="clearfix"></div>

                                    </div>
                                    </br>
                                    <div class="row"
                                    <div class="pull-right form-group">
                                        <label>Report Type:</label>
                                        <select id="report-type">
                                            <option value="data_table">Data Table</option>
                                            <option value="column_chart">Column Chart</option>
                                        </select>
                                    </div>
                                    </div>
                                        <div class="email-details-inner" data-padding="200">

                                        
                                        <div style="min-height:500px;overflow: auto;" >
                                            <div id="result" style="overflow: auto;"></div>
                                        </div>

                                    </div>
                                </section>

                            </div>
                        </section>
                    </div>
        </div>
    </div>
</div>

<div id="notification">
    <div id="title-preview" class="preview dis-none">
        <div class="alert alert-success media fade in">
            <h4 class="alert-title">Your info has been updated</h4>
            <p>You have successfully updated your personal informations.</p>
        </div>
    </div>
</div>



<script>

    


    var columnData = "[]";

    var table = '';

    $("#dbTable").on('change', function (event) {
        table = $("#dbTable").select2('val');
        tableChange(table);
    });

    function tableChange(table)
    {
        var request = $.ajax({
            url: "/get/autocomplete/columns/"+ table,
            type: "get",
            success: function (result) {

                var data_temp=$("#orderbyInput").val();

                $("#orderbyInput").parent().empty().html('<textarea id="orderbyInput" class="form-control" style="width:100%"></textarea>');
                $("#orderbyInput").val(data_temp);
                $("#orderbyInput").tagEditor({
                    delimiter: ',',
                    forceLowercase:false,
                    placeholder: 'Add Parameters ...',
                    maxLength:500,
                    autocomplete: { source: JSON.parse(result,true), minLength: 1, delay: 0, html: true, position: { collision: 'flip' } }
                });

               data_temp=$("#columnsInput").val();

                $("#columnsInput").parent().empty().html('<textarea id="columnsInput" class="form-control" style="width:100%"></textarea>');
                $("#columnsInput").val(data_temp);
                $("#columnsInput").tagEditor({
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


        var request = $.ajax({
            url: "/get/autocomplete/rows/"+ table,
            type: "get",
            success: function (result) {

               var data_temp=$("#rowsInput").val();

                $("#rowsInput").parent().empty().html('<textarea id="rowsInput" class="form-control" style="width:100%"></textarea>');
                $("#rowsInput").val(data_temp);
                $("#rowsInput").tagEditor({
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

                
                
            

        $.get("/process/getColumns/" + table, function (data) {
            columnData = data;
            $("#tableColumns").html("");
            $("#tableColumns").html(data);
        });

    }


    $('#getResult').on('click', function(){
        $("#result").load( "/process/resultTable/<?php echo $process->id; ?>/"+$('#report-type').val(), function(){
            generateNoty("The Process was Succesfully Executed","success");
        });

    });


    $('#save').click(function () {
        var data = { columns: [] };
        data['table'] = $("#dbTable").select2('val');
        data['columns'] = $("#columnsInput").val();
        data['rows'] = $("#rowsInput").val();
        data['orderby'] = $("#orderbyInput").val();
        data['descending'] = $("#descending").parent('[class*="icheckbox"]').hasClass("checked");
        data['limit'] = $("#limitInput").val();


        var request = $.ajax({
            url: "/process/save/<?php echo $process->id; ?>",
            type: "Post",
            data: { name: "<?php echo $process->name; ?>", parameters: JSON.stringify(data) , storage: "<?php echo $process->storage; ?>"},
            dataType: "json",
            success: function (result) {

                generateNoty("The Process Was Saved Succesfully","success");

            },
            error:function (result) {
                generateNoty("Oh No Something Went Wrong","danger");

            }
        });

    });


    jQuery(document).ready(function(){

        $('#descending').iCheck({
            labelHover: false,
            cursor: true
        }); 

        var parameters= <?php echo $process->parameters; ?>;

        $.getJSON("/get/DBTables", function (data) {
            $("#dbTable").select2({
                data: data
            });
            $("#dbTable").select2('val',parameters.table);
        });
        tableChange(parameters.table);
        tableChange(parameters.table);
        tableChange(parameters.table);
        tableChange(parameters.table);


        $("#columnsInput").val(parameters.columns);
        $("#rowsInput").val(parameters.rows);

        $("#orderbyInput").val(parameters.orderby);

        if(parameters.descending)
        {
            $("#descending").iCheck('check');
        }
        $("#limitInput").val(parameters.limit);

    });






</script>