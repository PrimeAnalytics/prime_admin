<?php
 echo $this->getContent();
?>
<style>
    .FormBuilder > ul {
        width: 100%;
        padding: 0;
        margin: 0;
    }

    div.DragTarget {
        border: 3px dashed gray;
    }

    div.Dropped {
        background-color: green;
    }

    div.FormElement {
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        padding: 10px;
        padding-top: 30px;
    }

        div.FormElement:hover {
            background-color: rgba(91, 192, 222, 0.8);
        }

    .placeHolder {
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        background-color: rgba(91, 192, 222, 0.5);
    }
</style>


<div class="row">
    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-header panel-controls">
                <h3>Editor</h3>
            </div>
            <div class="panel-content">
                <ul class="nav nav-tabs nav-primary">
                    <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Html</a></li>
                    <li><a href="#tab2_4" data-toggle="tab"><i class="icon-cloud-download"></i> Include</a></li>
                    <li><a href="#tab2_5" data-toggle="tab"><i class="icon-cloud-download"></i> Parameters</a></li>
                    <li><a href="#tab2_7" data-toggle="tab"><i class="icon-cloud-download"></i> Live Preview</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab2_1">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <h3>Style</h3>
                                    <button id="cssstyle" class="btn btn-info pull-right">Inteli-Format</button>
                                </div>
                                <div class="row">
                                    <div id="css-editor" style="height:300px"></div>
                                </div>
                                <div class="row">
                                    <h3>Html</h3>
                                    <button id="htmlbody" class="btn btn-info pull-right">Inteli-Format</button>
                                </div>
                                <div class="row">
                                    <div id="html-editor" style="height:700px"></div>
                                </div>
                                <div class="row">

                                    <h3>Script</h3>
                                    <button id="jsscript" class="btn btn-info pull-right">Inteli-Format</button>
                                </div>
                                <div class="row">

                                    <div id="js-editor" style="height:300px"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <table style="width:100%"> <tr><td><h3>Data Format:</h3></td>
                                    <td>
                                    <input id="dataFormat" class="form-control" style="width:150px"></input>
                                    </td>
                                    </tr></table>
                                

                                    <h3>Helpers</h3>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($helpers as $name => $value) { ?>
                                        <tr>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $value; ?></td>
                                        </tr>
                                        <?php } ?>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2_4">
                        <div class="row">
                            <h3>CSS URLs</h3>
                            <button id="csslinks" class="btn btn-info pull-right">Inteli-Format</button>
                        </div>
                        <div class="row">
                            <div id="css-links" style="height:150px"></div>
                        </div>
                        <div class="row">
                            <h3>JS URLs</h3>
                            <button id="jslinks" class="btn btn-info pull-right">Inteli-Format</button>
                        </div>
                        <div class="row">
                            <div id="js-links" style="height:150px"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2_5" style="min-height: 500px; height:auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel-group panel-accordion" id="accordion">

                                    <?php
                foreach($formElementList as $key=>$subfiles)
                {
                  echo '<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$key.'">
                                                    '.$key.'
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse'.$key.'" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="FormTools">
                                                    <div class="FormElementMenu">';
                foreach($subfiles as $subfile)
                {
                     $type= strtolower($key)."/".strtolower(str_replace(" ","_",$subfile)) ;
                echo '<a class="btn btn-success btn-block" data-formtype="'.$type.'">'.$subfile.'</a>';
                }
                echo '</div>
                                                </div>
                                            </div>
</div>
</div>
                                       ';
                }
                                    ?>

                                </div>
                            </div>

                            <div class="FormBuilder col-md-8" style="min-height: 225px;">
                                <table class="table table-striped">
                                    <thead>
                                    <th>Type</th>
                                    <th>Parameters</th>
                                    <th></th>
                                    </thead>
                                    <tbody id="parameters"></tbody>

                                </table>
                            </div>
                        </div>

                        </div>

                    <div class="tab-pane fade" id="tab2_7">

                        <h3>Live  <strong>Preview</strong></h3>
                        <div class="pull-right">
                            <button id="previewrun" class="btn btn-success">Run</button>
                            <button id="saveWidget" class="btn btn-primary">Save</button>
                        </div>

                        <iframe src="/theme_creator/preview" id="previewframe" width="100%" height="700"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>







<script>
    // This makes the Builder Elements Sortable
    $("#parameters").sortable({
        placeholder: "placeHolder",
        opacity: 0.5,
        start: function (e, ui) {
            ui.placeholder.height(ui.helper.outerHeight());
        }
    });


    $(".FormTools .btn").draggable({
        revert: "invalid",
        opacity: 0.5,
        helper: "clone",
        cursor: "crosshair ",
        start: function (event, ui) {
            $(this).css("z-index", 10);
            $(".FormBuilder").addClass("DragTarget");
        },
        stop: function (event, ui) {
            $(".FormBuilder").removeClass("DragTarget");
        }
    });
    $(".FormBuilder").droppable({
        accept: "a",
        drop: function (event, ui) {
            var element;
            $(this).animate({ backgroundColor: ["#5BC0DE", "swing"] }, 200);
            $(this).animate({ backgroundColor: ["#fff", "swing"] }, 200);
            var ElementType = ui.draggable.data('formtype');
            FormElement(ElementType,null);
        }
    });

    function FormElement(elementType,objValue) {
        var ContainerDiv = getMainContainer();
        var inputElement;
        var elementString;


        $.get("/form_elements/" + elementType + "/getForm", function (data) {

            data = JSON.parse(data);
            if(objValue!=null)
            {
                data=objValue;

            }
            inputElement = "<td>"+getElementLayout(data)+"</td>";

            var res = elementType.split("/");
            res[1] = res[1].split("_").join(" ");
            res = res.join(": ");

            res = toProperCase(res);

            ContainerDiv.append(getFormElementHeader(res, elementType));

            if (inputElement) {
                ContainerDiv.append(inputElement);
            }

            ContainerDiv.append("<td><button class=\"btn pull-right btn-sm btn-danger btn-rounded delete\">Remove</button></td>");

            $(".FormBuilder").find("tbody").append(ContainerDiv);


            $(".delete").on('click', function (event) {
                $(this).parent().parent().remove();
            });
        });


    }

    function getMainContainer() {
        return $("<tr>", {
            class: "FormElement"
        });
    }

    function getElementLayout(data) {
        var out = "";

        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                if(key!="type")
                {
                    out = out + "<div class=\"form-group\"><input name=\"" + key + "\" type=\"text\" placeholder=\"" + toProperCase(key) + "\" class=\"form-control\" value=\""+data[key]+"\"></input></div>";
                }
            }
        }
        return out;
    }


    function toProperCase(s) {
        return s.toLowerCase().replace(/^(.)|\s(.)/g,
                function ($1) { return $1.toUpperCase(); });
    }

    function getFormElementHeader(DisplayText,Type) {
        return $("<td>", {
            class: "elementHeader",
            name:Type,
            html: DisplayText
        });
    }

</script>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal">
        <div id="modal_content"></div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script src="/assets/global/plugins/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/global/plugins/ace/ext-language_tools.js"></script>

<script>
    ace.require("ace/ext/language_tools");


    var htmleditor = ace.edit("html-editor");
    htmleditor.setTheme("ace/theme/monokai");
    htmleditor.getSession().setMode("ace/mode/html");
    htmleditor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true
    });

    var csseditor = ace.edit("css-editor");
    csseditor.setTheme("ace/theme/monokai");
    csseditor.getSession().setMode("ace/mode/css");
    csseditor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true
    });

    var jseditor = ace.edit("js-editor");
    jseditor.setTheme("ace/theme/monokai");
    jseditor.getSession().setMode("ace/mode/javascript");
    jseditor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true
    });


    var jslinks = ace.edit("js-links");
    jslinks.setTheme("ace/theme/monokai");
    jslinks.getSession().setMode("ace/mode/html");

    var csslinks = ace.edit("css-links");
    csslinks.setTheme("ace/theme/monokai");
    csslinks.getSession().setMode("ace/mode/html");

    $("#previewrun").click(function () {
        
        var request = $.ajax({
            url: "/theme_creator/widget_preview/<?php echo $widget_id; ?>",
            type: "Post",
            data: { css: csslinks.getValue(), js: jslinks.getValue(), script: jseditor.getValue(), style: csseditor.getValue(), html: htmleditor.getValue(), form: getParameters() },
            dataType: "html",
            success: function (result) {
                var previewDoc = window.frames[0].document;
                previewDoc.write("<!DOCTYPE html>");
                previewDoc.write("<html>");
                previewDoc.write(result);
                previewDoc.write("</html>");
                previewDoc.close();
            },
            error:function (result) {
                alert(result);
            }
        });
    });

    $("#csslinks").click(function () {
        var request = $.ajax({
            url: "/theme_creator/inteli_format/<?php echo $theme_name; ?>/css",
            type: "Post",
            data: csslinks.getValue(),
            dataType: "html",
            success: function (result) {
                csslinks.setValue(result);
            }
        });

    });

    $("#jslinks").click(function () {
        var request = $.ajax({
            url: "/theme_creator/inteli_format/<?php echo $theme_name; ?>/js",
            type: "Post",
            data: jslinks.getValue(),
            dataType: "html",
            success: function (result) {
                jslinks.setValue(result);
            }
        });

    });

    $("#htmlbody").click(function () {
        var request = $.ajax({
            url: "/theme_creator/inteli_format/<?php echo $theme_name; ?>/body",
            type: "Post",
            data: htmleditor.getValue(),
            dataType: "html",
            success: function (result) {
                htmleditor.setValue(result);
            }
        });

    });

    $("#jsscript").click(function () {
        var request = $.ajax({
            url: "/theme_creator/inteli_format/<?php echo $theme_name; ?>/script",
            type: "Post",
            data: jseditor.getValue(),
            dataType: "html",
            success: function (result) {
                jseditor.setValue(result);
            }
        });

    });

    $("#cssstyle").click(function () {
        var request = $.ajax({
            url: "/theme_creator/inteli_format/<?php echo $theme_name; ?>/style",
            type: "Post",
            data: csseditor.getValue(),
            dataType: "html",
            success: function (result) {
                csseditor.setValue(result);
            }
        });

    });

    function getParameters() {
        var data = [];
        $('#parameters tr').each(function (i) {
            var temp = {};
            temp['type'] = $(this).find('td:first').attr("name");
            $(this).find("input").each(function () {
                temp[$(this).attr("name")] = $(this).val();
            });

            data.push(temp);
        });

        return JSON.stringify(data);
    };


    $("#saveWidget").click(function () {
        $.post("/theme_creator/widget_save/<?php echo $widget_id; ?>", { css: csslinks.getValue(), js: jslinks.getValue(), script: jseditor.getValue(), style: csseditor.getValue(), html: encodeURIComponent(htmleditor.getValue()), form: getParameters(), data_format: $("#dataFormat").select2('data').id }, function(data){
            $("#modal_content").html(data);
                    $("#myModal").modal("show");
        });
    });


    jQuery(document).ready(function(){

        csslinks.setValue(<?php echo json_encode($css); ?>);
        jslinks.setValue(<?php echo json_encode($js); ?>);
        jseditor.setValue(<?php echo json_encode($script); ?>);
        csseditor.setValue(<?php echo json_encode($style); ?>);
        htmleditor.setValue(<?php echo json_encode($html); ?>);

        var form=JSON.parse(<?php echo json_encode($form); ?>);
        var i=0;
        $.each(form, function(idx, obj) {
            FormElement(obj.type,obj);
        });


        dataFormat=[{id: "ByRow",text: "By Row"},{id: "ByColumn",text: "By Column"},{id: "Chart",text: "Chart Data"}];

        $("#dataFormat").select2({
            data: dataFormat
        });

        $("#dataFormat").val('<?php echo $data_format; ?>').trigger("change");

    });




</script>




