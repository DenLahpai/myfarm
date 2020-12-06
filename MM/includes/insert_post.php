<?php  
require_once "../../functions.php";

//Inserting data to the table post
$link = table_Posts ('insert', NULL, NULL, NULL, NULL);
if ($link == 1) {
	// 1 is returned if there is a connection error
	echo 1;
}
elseif ($link != 1) {
	if (isset($_FILES['Image']) || !empty($_FILES['Image'])) {
		$file = $_FILES['Image'];
		if ($file['error'] == 0) {
			$ext = explode('.', $file['name']);
			$file_ext = strtolower(end($ext));
			$folder_path = "../../uploads/";
			$file_name = uniqid('', true).'.'.$file_ext;
			$path = "../../uploads/".$file_name;
	
			move_uploaded_file($file['tmp_name'], $path);
			table_Images ('insert', $link, $file_name, NULL, NULL);
			
			// $thumb_name = uniqid('thumb_', true).'.'.$file_ext;
			$thumb_path = "../../uploads/thumb_".$file_name;
			CreateThumbnail($path, $thumb_path, 300, $quatlity = 100);
			
		}
		else {
			// no image!
			echo 0;
		}
	}	
}



?>