<?php  

require_once "../functions.php";

function correctImageOrientation($filename) {
  if (function_exists('exif_read_data')) {
    $exif = exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);        
        }
        // then rewrite the rotated image back to the disk as $filename 
        imagejpeg($img, $filename, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists      
}


if (isset($_FILES['Image']['name'])) {
	$name = $_FILES['Image']['name'];
	$size = $_FILES['Image']['size'];
	$tmp_ext = explode(".", $name);
	$ext = end($tmp_ext);
	$allowed_ext = array("png", "jpg", "jpeg");
	if (in_array($ext, $allowed_ext)) {
		$new_name =  uniqid('Img_', true).'.'.$ext;
		$path = "../uploads/".$new_name;
		move_uploaded_file($_FILES['Image']['tmp_name'], $path);

		// $thumb_name = uniqid('thumb_', true).'.'.$ext;
		// $path_thumb = "../uploads/".$thumb_name;
		// CreateThumbnail($path,$path_thumb,300, $quality = 100);]
		$a = getimagesize($path);
		print_r($a);

	}
}
else {

}


// $exif = exif_read_data("../uploads/5f042c8e9d93a7.79297547.png");
// print_r($exif);	
// echo "<br>";
// echo "<br>";
// echo $exif['Orientation'];

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form id="post-form" method="post" action="#" enctype="multipart/form-data">
        <div>
            <label for="Image">Upload Image</label>
            <input type="file" name="Image" id="Image">
        </div>
        <div>
           <button type="submit" id="btn-submit" name="btn-submit" >Post</button>
        </div>
    </form>
</body>
</html>

function checkForRemainingData () {
    var i = $("#remaining-data").html();
    if (i <= 0) {
        $("#btn-load-more").attr('disabled', 'disabled');
        $("#btn-load-more").html('No More Posts!');
    }
    else {
        $("#btn-load-more").removeAttr('disabled', 'disabled');
        $("#btn-load-more").html('Load More');
    }
}

function reloadPosts (source) {
    var sorting = $("#sorting").val();
    var search = $("#search").val().trim();
    var limit = $("#limit").val();
    
    checkForRemainingData ();

    $.post ('includes/' + source, {
        sorting: sorting,
        search: search,
        limit: limit
        }, function(data) {
            $("#posts-data").html(data);
        }
    );
}