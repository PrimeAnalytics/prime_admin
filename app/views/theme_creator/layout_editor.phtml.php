<?php echo $this->getContent(); ?>
<div class="row">
    <div class="col-md-6 portlets">
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 portlets">
        <div class="panel">
            <div class="panel-header panel-controls">
                <h3>Live  <strong>Preview</strong></h3>
                <button id="previewrun" class="btn btn-info">Run</button>
                <iframe src="/theme_creator/preview" id="previewframe" width="100%" height="700"></iframe>
            </div>
            <div class="panel-content">

            </div>
        </div>
    </div>
</div>

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

</script>
