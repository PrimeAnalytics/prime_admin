<?php
 echo $this->getContent(); ?>
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
                    <li class=""><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Html</a></li>
                    <li class="active"><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Css</a></li>
                    <li><a href="#tab2_3" data-toggle="tab"><i class="icon-cloud-download"></i> Script</a></li>
                    <li><a href="#tab2_4" data-toggle="tab"><i class="icon-cloud-download"></i> Include</a></li>
                    <li><a href="#tab2_5" data-toggle="tab"><i class="icon-cloud-download"></i> Parameters</a></li>
                    <li><a href="#tab2_6" data-toggle="tab"><i class="icon-cloud-download"></i> Assets</a></li>
                    <li><a href="#tab2_7" data-toggle="tab"><i class="icon-cloud-download"></i> Live Preview</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab2_1">
                        <button id="htmlbody" class="btn btn-info">Inteli-Format</button>
                        <div id="html-editor" style="height:700px"></div>
                    </div>
                    <div class="tab-pane fade" id="tab2_2">
                        <button id="cssstyle" class="btn btn-info">Inteli-Format</button>
                        <div id="css-editor" style="height:700px"></div>
                    </div>
                    <div class="tab-pane fade" id="tab2_3">
                        <button id="jsscript" class="btn btn-info">Inteli-Format</button>
                        <div id="js-editor" style="height:700px"></div>
                    </div>
                    <div class="tab-pane fade" id="tab2_4">
                        
                        <h3>CSS URLs</h3>
                        <button id="csslinks" class="btn btn-info">Inteli-Format</button>
                        <div id="css-links" style="height:150px"></div>

                        <h3>JS URLs</h3>
                        <button id="jslinks" class="btn btn-info">Inteli-Format</button>
                        <div id="js-links" style="height:150px"></div>
                        
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

                            <div class="FormBuilder col-md-8" role="main" style="min-height: 225px;">
                                <ul></ul>
                            </div>

                        </div>
                      
                    </div>

                    <div class="tab-pane fade" id="tab2_6">
                        <h3>UPLOAD ASSETS</h3>
                        <form action="/theme_creator/upload_assets/<?php echo $theme_name?>" enctype="multipart/form-data" method="post" class="dropzone">
                            <div class="fallback">
                                <input type="file" name="zip_file" />
                                <input type="submit" name="submit" value="Upload" />
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="tab2_7">

                                <h3>Live  <strong>Preview</strong></h3>
                        <div class="pull-right">
                                <button id="previewrun" class="btn btn-success">Run</button>
                                <button id="saveDashboard" class="btn btn-primary">Save</button>
                                <button id="publishDashboard" class="btn btn-warning">Publish</button>
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
    $(".FormBuilder ul").sortable({
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
            FormElement(ElementType);
        }
    });

    function FormElement(elementType) {
        var ContainerDiv = getMainContainer();
        var inputElement;
        var elementString;

        $.get("/form_elements/" + elementType + "/getForm", function (data) {

            data = JSON.parse(data);
            inputElement = getElementLayout(data);

            var res = elementType.split("/");
            res[1] = res[1].split("_").join(" ");
            res = res.join(": ");

            res = toProperCase(res);

            ContainerDiv.append(getFormElementHeader(res));

            if (inputElement) {
                ContainerDiv.append(inputElement);
            }

            ContainerDiv.append("<div class=\"form-group \"><button class=\"btn btn-warning pull-right\">Remove</button> </br></br></div>");

            $(".FormBuilder").find("ul").append(ContainerDiv);
        });


    }

    function getMainContainer() {
        return $("<div>", {
            class: "FormElement"
        });
    }

    function getElementLayout(data) {
        var out = "";
        
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                out = out + "<div class=\"form-group\"><label>" + toProperCase(key) + "</label><input type=\"text\" placeholder=\"" + toProperCase(key) + "\" class=\"form-control\"></input></div>";;
            }
        }
        return out;
    }


    function toProperCase(s) {
        return s.toLowerCase().replace(/^(.)|\s(.)/g,
                function ($1) { return $1.toUpperCase(); });
    }

    function getFormElementHeader(DisplayText) {
        return $("<label>", {
            class: "elementHeader",
            html: DisplayText
        });
    }

</script>


<script src="/assets/global/plugins/ace/ace.js" type="text/javascript" charset="utf-8"></script>

<script>
    var htmleditor = ace.edit("html-editor");
    htmleditor.setTheme("ace/theme/monokai");
    htmleditor.getSession().setMode("ace/mode/html");

    var csseditor = ace.edit("css-editor");
    csseditor.setTheme("ace/theme/monokai");
    csseditor.getSession().setMode("ace/mode/css");

    var jseditor = ace.edit("js-editor");
    jseditor.setTheme("ace/theme/monokai");
    jseditor.getSession().setMode("ace/mode/javascript");


    var jslinks = ace.edit("js-links");
    jslinks.setTheme("ace/theme/monokai");
    jslinks.getSession().setMode("ace/mode/html");

    var csslinks = ace.edit("css-links");
    csslinks.setTheme("ace/theme/monokai");
    csslinks.getSession().setMode("ace/mode/html");

    $("#previewrun").click(function () {
        var request = $.ajax({
            url: "/theme_creator/preview",
            type: "Post",
            data: {css:csslinks.getValue(),js:jslinks.getValue(),script:jseditor.getValue(),style:csseditor.getValue(),html:htmleditor.getValue()},
            dataType: "html",
            success: function (result) {
                var previewDoc = window.frames[0].document;
                previewDoc.write("<!DOCTYPE html>");
                previewDoc.write("<html>");
                previewDoc.write(result);
                previewDoc.write("</html>");
                previewDoc.close();
            }
        });
    });

    $("#csslinks").click(function () {
        var request = $.ajax({
            url: "/theme_creator/inteli_format/make/css",
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
            url: "/theme_creator/inteli_format/make/js",
            type: "Post",
            data:jslinks.getValue(),
            dataType: "html",
            success: function (result) {
                jslinks.setValue(result);
            }
        });

    });

    $("#htmlbody").click(function () {
        var request = $.ajax({
            url: "/theme_creator/inteli_format/make/body",
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
            url: "/theme_creator/inteli_format/make/script",
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
            url: "/theme_creator/inteli_format/make/style",
            type: "Post",
            data: csseditor.getValue(),
            dataType: "html",
            success: function (result) {
                csseditor.setValue(result);
            }
        });

    });


    $("#saveDashboard").click(function () {
        $.post("/theme_creator/save_dashboard/make/new", { css: csslinks.getValue(), js: jslinks.getValue(), script: jseditor.getValue(), style: csseditor.getValue(), html: htmleditor.getValue(), parms: "2pm" });
    });
</script>










