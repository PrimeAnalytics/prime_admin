
<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <?php echo $this->tag->form("theme_creator/dashboard_create") ?>
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New Dashboard.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Dashboard Name</label>
                    <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Preview Image</label>
                    <input type="file" id="image" class="form-control" data-placeholder="Choose Image to Upload">
                    </input>
                    <input name="image" type="hidden"></input>
                    <div id="response"></div>
                </div>
            </div>
            </div>
    </div>
    <div class="modal-footer bg-blue">
        <?php echo $this->tag->hiddenField("theme_id") ?>
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>
</div>


<script>

(function () {
	var input = document.getElementById("image"),
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
                $('[name="image"]').val(res);
			    document.getElementById("response").innerHTML = res;
				}
			});
		}
	}, false);
}());

</script>
