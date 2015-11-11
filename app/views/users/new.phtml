
<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <?php echo $this->tag->form("users/create") ?>
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New User.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row form-row">
            <div class="col-md-6 form-group">
                <label class="form-label">Full Name</label>
                <?php echo $this->tag->textField(array("full_name", "class" => "form-control")) ?>
            </div>

            <div class="col-md-6 form-group">
                <label>Profile Picture</label>
                <input type="file" id="file_select" class="form-control" data-placeholder="Choose Image to Upload">
                </input>
                <input name="image_path" type="hidden"></input>
                <div id="response"></div>
            </div>


        </div>

        <div class="row form-row">
            <div class="col-md-4 form-group">
                <label class="form-label">Email</label>
                <?php echo $this->tag->textField(array("email", "class" => "form-control")) ?>
            </div>

            <div class="col-md-4 form-group">
                <label class="form-label">Password</label>
                <?php echo $this->tag->passwordField(array("password", "class" => "form-control")) ?>
            </div>

            <div class="col-md-4 form-group">
                <label class="form-label">Role</label>
                <?php echo $this->tag->selectStatic(array("role", "class" => "form-control"), array("User" => "User", "Supervisor" => "Supervisor")) ?>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-blue">
        <?php echo $this->tag->hiddenField("status") ?>
        <?php echo $this->tag->hiddenField("organisation_id") ?>
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>

    <script>

        (function () {
            var input = document.getElementById("file_select"), 
                formdata = false; 

            if (window.FormData) {
                formdata = new FormData();
            }
	
            input.addEventListener("change", function (evt) {
                document.getElementById("response").innerHTML = "Uploading . . ."
                var i = 0, len = this.files.length, img, reader, file;
	
                for ( ; i < len; i++ ) {
                    file = this.files[i];
                    if (!!file.type.match('image.*')) {
                        if ( window.FileReader ) {
                            reader = new FileReader();
                    reader.onloadend = function (e) { 
					
                    };
                    reader.readAsDataURL(file);
                }
                if (formdata) {
                    formdata.append("images[]", file);
                }
            }	
            }
	
		if (formdata) {
			$.ajax({
        url: "/form_elements/parameters/ImageUpload/upload",
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (res) {
            $('[name="image_path"]').val(res);
        document.getElementById("response").innerHTML = res; 
        }
        });
        }
        }, false);
        }());


    </script>

</div>
