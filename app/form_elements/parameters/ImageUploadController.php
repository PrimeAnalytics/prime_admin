<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class ImageUploadController extends FormElementBase
{
    
    public function Render($name,$label)
    {
        $output=array();
        $output['html'][]='<div class="form-group">
                                    <label>'.$label.'</label>
                                        <input type="file" id="'.$name.'" class="form-control" data-placeholder="Choose Image to Upload">
                                        </input>
<input name="parameters['.$name.']" type="hidden"></input>
<div id="response"></div>
                                </div>';


        $output['js'][]= '(function () {
	var input = document.getElementById("'.$name.'"), 
		formdata = false; 

	if (window.FormData) {
  		formdata = new FormData();
	}
	
 	input.addEventListener("change", function (evt) {
 		document.getElementById("response").innerHTML = "Uploading . . ."
 		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
			if (!!file.type.match(\'image.*\')) {
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
                $(\'[name="parameters['.$name.']"]\').val(res);
			    document.getElementById("response").innerHTML = res; 
				}
			});
		}
	}, false);
}());


';

        return $output;

    }

    public function getFormAction()
    {
        $data['name']="";
        $data['label']="";
        echo json_encode($data);
    }


    public function uploadAction($id)
    {

foreach ($_FILES["images"]["error"] as $key => $error) {
    $files    = glob('./files/');      // get all files in folder
    natsort($files);                         // sort
    $lastFile = pathinfo(array_pop($files)); // split $lastFile into parts
    $newFile  = $lastFile['filename'] +1;    // increase filename by 1

    if(file_exists("./files/$newFile")) { // do not write file if it exists
        die("$newFile aready exists");
    }    
    
    if ($error == UPLOAD_ERR_OK) {
        $name = $_FILES["images"]["name"][$key];
        move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "./files/" .$newFile.$_FILES['images']['name'][$key]);
        echo "/files/".$newFile.$_FILES['images']['name'][$key];
    }

}
        }


}
