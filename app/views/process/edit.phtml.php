﻿<div class="col-md-12 portlets">
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Table Columns</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableColumns">
                                                    
                                                    <tr>
                                                        <td>Username</td>
                                                       
                                                    </tr>
                                                </tbody>
                                            </table>
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
                                    <div class="email-details-inner" data-padding="200">
                                        <div style="min-height:500px">
                                            <div id="result"></div>
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
                var data_temp=$("#columnsInput").val();

                $("#columnsInput").parent().empty().html('<textarea id="columnsInput" class="form-control" style="width:100%"></textarea>');
                $("#columnsInput").val(data_temp);
                $("#columnsInput").tagEditor({
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
                    placeholder: 'Add Parameters ...',
                    maxLength:500,
                    autocomplete: { source: JSON.parse(result,true), minLength: 1, delay: 0, html: true, position: { collision: 'flip' } }
                });
                
            },
            error:function (result) {

            }
        });

                
                
            

        $.getJSON("/get/DBColumns/" + table +"/true", function (data) {
            columnData = data;
            $("#tableColumns").html("");
            $.each(columnData, function(i, item) {
                $("#tableColumns").append("<tr><td>"+columnData[i].text+"</td></tr>");
            });
        });

    }


    $('#getResult').on('click', function(){
        $("#result").load( "/process/resultTable/<?php echo $process->id; ?>", function(){
            generateNoty("The Process was Succesfully Executed","success");
        });

    });


    $('#save').click(function () {
        var data = { columns: [] };
        data['table'] = $("#dbTable").select2('val');
        data['columns'] = $("#columnsInput").val();
        data['rows'] = $("#rowsInput").val();


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

    });






</script>