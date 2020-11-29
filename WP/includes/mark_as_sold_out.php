<?php  
require_once "../../functions.php";
if (isset($_POST['Id'])) {
	//checking if current user is the post owner
	$rows_Posts = table_Posts ('select_one', $_POST['Id'], NULL, NULL, NULL);
	foreach ($rows_Posts as $row_Posts) {
		# code...
	}
	if ($_SESSION['UsersId'] != $row_Posts->UsersId) {
		echo "Only the owner of this post can edit!";
	}
	else {
		table_Posts ('mark_as_sold_out', $_POST['Id'], NULL, NULL, NULL);	
	}
}
?>
