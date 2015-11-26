<?php
namespace PRIME\FormElements\Parameters;
use PRIME\FormElements\FormElementBase as FormElementBase;

class ImageUploadController extends FormElementBase
{
    
    public function Render($name,$label,$height,$width)
    {
        $output=array();
        $output['html'][]='

<div class="form-group">
                                    <label>'.$label.'</label>
<input name="parameters['.$name.']" type="hidden"></input>
<div id="crop'.$name.'" class="img-container" style="height:300px;width:550px; position: relative;margin:0;" >
<img src="/assets/global/images/logo/logo-white-sidebar.png"></img></div>
<input type="file" id="cropbutton'.$name.'">
<button type="button" id="save'.$name.'">Save</button>
                                </div>			
';


        $output['js'][]= '


var $image'.$name.' = $("#crop'.$name.' img");
$image'.$name.'.cropper({aspectRatio: '.$width/$height.',dragMode:\'move\'});

 // Import image
  var $inputImage'.$name.' = $(\'#cropbutton'.$name.'\');
  var URL'.$name.' = window.URL || window.webkitURL;
  var blobURL'.$name.';

  if (URL) {
    $inputImage'.$name.'.change(function () {
      var files = this.files;
      var file;

      if (!$image'.$name.'.data(\'cropper\')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          blobURL'.$name.' = URL'.$name.'.createObjectURL(file);
          $image'.$name.'.one(\'built.cropper\', function () {

            // Revoke when load complete
            URL'.$name.'.revokeObjectURL(blobURL'.$name.');
          }).cropper(\'reset\').cropper(\'replace\', blobURL'.$name.');
          $inputImage'.$name.'.val(\'\');
        } else {
          window.alert(\'Please choose an image file.\');
        }
      }
    });
  } else {
    $inputImage'.$name.'.prop(\'disabled\', true).parent().addClass(\'disabled\');
  }


$("#save'.$name.'").on("click",function(){
var canvas = $($image'.$name.').cropper(\'getCroppedCanvas\', {
  width: '.$width.',
  height:'.$height.'
});

var dataURL = canvas.toDataURL();


$.ajax({
  type: "POST",
  url: \'/form_elements/parameters/ImageUpload/upload\',
  data: { 
     imgBase64: dataURL
  },
success: function(data) {
data = JSON.parse(data);
$(\'[name="parameters['.$name.']"]\').val(data.url);

}
})
});

		

';

        return $output;

    }

    public function getFormAction()
    {
        $data['name']="";
        $data['label']="";
        $data['height']="300";
        $data['width']="500";
        echo json_encode($data);
    }


    public function uploadAction()
    {


        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        

    $files    = glob('./files/*');      // get all files in folder
    natsort($files);                         // sort
    $lastFile = pathinfo(array_pop($files)); // split $lastFile into parts
    $newFile  = $lastFile['filename'] +1;    // increase filename by 1

    if(file_exists("./files/$newFile")) { // do not write file if it exists
        die("$newFile aready exists");
    }    

     file_put_contents("./files/" .$newFile."image.png",$data);


     $response = array(
                  "status" => 'success',
                  "url" => "/files/".$newFile."image.png"
                );

        print json_encode($response);

    }
    
    
    public function uploadextAction()
    {

    
        $imagePath = "./files/";

        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $_FILES["img"]["name"]);
        $extension = end($temp);
        
        //Check write Access to Directory

        if(!is_writable($imagePath)){
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t upload File; no write Access'
            );
            print json_encode($response);
            return;
        }
        
        if ( in_array($extension, $allowedExts))
        {
            if ($_FILES["img"]["error"] > 0)
            {
                $response = array(
                   "status" => 'error',
                   "message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
               );			
            }
            else
            {
                
                $filename = $_FILES["img"]["tmp_name"];
                list($width, $height) = getimagesize( $filename );


                $files    = glob('./files/*');      // get all files in folder
                natsort($files);                         // sort
                $lastFile = pathinfo(array_pop($files)); // split $lastFile into parts
                $newFile  = $lastFile['filename'] +1;    // increase filename by 1

                if(file_exists("./files/$newFile")) { // do not write file if it exists
                    die("$newFile aready exists");
                }    

                move_uploaded_file($filename,  $imagePath .$newFile. $_FILES["img"]["name"]);

                $response = array(
                  "status" => 'success',
                  "url" => "/files/".$newFile.$_FILES['img']['name'],
                  "width" => $width,
                  "height" => $height
                );
                
            }
        }
        else
        {
            $response = array(
                 "status" => 'error',
                 "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
             );
        }
        
        print json_encode($response);
    
    
    }







    public function cropAction()
    {
        

        if(true){

            /*
             *	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
             */
            $imgUrl = ".".$_POST['imgUrl'];
            // original sizes
            $imgInitW = $_POST['imgInitW'];
            $imgInitH = $_POST['imgInitH'];
            // resized sizes
            $imgW = $_POST['imgW'];
            $imgH = $_POST['imgH'];
            // offsets
            $imgY1 = $_POST['imgY1'];
            $imgX1 = $_POST['imgX1'];
            // crop box
            $cropW = $_POST['cropW'];
            $cropH = $_POST['cropH'];
            // rotation angle
            $angle = $_POST['rotation'];




            //$imgUrl = 'https://lh6.ggpht.com/SkwnZx2duBQfzregu8_4PnBOnADfYG4VND1J6TfRTDl57a_vn4vOA_ZQqjqEJQ4pm9A_=h900';



            

            $jpeg_quality = 100;

          //  $output_filename = "./files/croppedImg_".rand();

            // uncomment line below to save the cropped image in the same location as the original image.
            $output_filename = $imgUrl;

            $what = getimagesize($imgUrl);

            switch(strtolower($what['mime']))
            {
                case 'image/png':
                    $img_r = \imagecreatefrompng($imgUrl);
                    $source_image = \imagecreatefrompng($imgUrl);
                    $type = '.png';
                    break;
                case 'image/jpeg':
                    $img_r = \imagecreatefromjpeg($imgUrl);
                    $source_image = \imagecreatefromjpeg($imgUrl);
                    error_log("jpg");
                    $type = '.jpeg';
                    break;
                case 'image/gif':
                    $img_r = \imagecreatefromgif($imgUrl);
                    $source_image = \imagecreatefromgif($imgUrl);
                    $type = '.gif';
                    break;
                default: die('image type not supported');
            }


            //Check write Access to Directory

            if(!is_writable(dirname($output_filename))){
                $response = Array(
                    "status" => 'error',
                    "message" => 'Can`t write cropped File'
                );	
            }else{

                // resize the original image to size of editor
                $resizedImage = \imagecreatetruecolor($imgW, $imgH);
                \imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
                // rotate the rezized image
                $rotated_image = \imagerotate($resizedImage, -$angle, 0);
                // find new width & height of rotated image
                $rotated_width = \imagesx($rotated_image);
                $rotated_height = \imagesy($rotated_image);
                // diff between rotated & original sizes
                $dx = $rotated_width - $imgW;
                $dy = $rotated_height - $imgH;
                // crop rotated image to fit into original rezized rectangle
                $cropped_rotated_image = \imagecreatetruecolor($imgW, $imgH);
                \imagecolortransparent($cropped_rotated_image, \imagecolorallocate($cropped_rotated_image, 0, 0, 0));
                \imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
                // crop image into selected area
                $final_image = \imagecreatetruecolor($cropW, $cropH);
                \imagecolortransparent($final_image, \imagecolorallocate($final_image, 0, 0, 0));
                \imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
                // finally output png image
                //imagepng($final_image, $output_filename.$type, $png_quality);
                \imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
                $response = Array(
                    "status" => 'success',
                    "url" => substr($output_filename, 1).$type,
                    "extra" => $_POST['imgUrl']
                );
            }

            print json_encode($response);
        }

    }


}
