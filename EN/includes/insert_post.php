<?php  
require_once "../../functions.php";

//Inserting data to the table post
$link = table_Posts ('insert', NULL, NULL, NULL, NULL);

if (isset($_FILES['Image'])) {
	$file = $_FILES['Image'];
	if ($file['error'] == 0) {
		$ext = explode('.', $file['name']);
		$file_ext = strtolower(end($ext));
		$folder_path = "../../uploads/";
		$file_name = uniqid('', true);

		$sourceProperties = getimagesize($file['tmp_name']);
		$imageType = $sourceProperties[2];

		switch ($imageType) {
			
			case IMAGETYPE_PNG:
				$imageResourceId = imagecreatefrompng($file['tmp_name']);
				$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
				imagepng($targetLayer, $folder_path."thumb_".  $file_name.'.'. $file_ext);
				break;

			case IMAGETYPE_JPEG:
				$imageResourceId = imagecreatefromjpeg($file['tmp_name']);
				$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
				imagejpeg($targetLayer, $folder_path."thumb_".  $file_name.'.'. $file_ext);
				break;	
			
			default:
				# code...
				break;
		}
		move_uploaded_file($file['tmp_name'], $folder_path.$file_name.".".$file_ext);
		table_Images ('insert', $link, $file_name.'.'.$file_ext, NULL, NULL);
	}
	else {
		// one is returned if is an error!
		echo 1;
	}
}

else {
	if ($link != "Error!") {
		// zero is returned if there is no error!
		echo 0;
	}
	else {
		// 1 is returned if there is a connection error
		echo 1;
	}
}


?>