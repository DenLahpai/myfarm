<?php  
require_once "../../functions.php";
if (isset($_SESSION['UsersId'])) {
	if (isset($_POST['CommentsId'])) {
		// getting Comments Link 
		$rows_Comments = table_Comments ('select_one', $_POST['CommentsId'], NULL, NULL, NULL);
		foreach ($rows_Comments as $row_Comments) {
			# code...
		}

		// getting UsersLink
		$rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL, NULL, NULL);
		foreach ($rows_Users as $row_Users) {
			# code...
		}

		//Inserting data to the table Relies 
		table_Replies ('insert', $row_Comments->Link, $row_Users->Link, NULL, NULL);

		//Updating post update time
		table_Posts ('update_time', $row_Comments->PostsLink, NULL, NULL, NULL);

		//Sending notifications to the commenter owner
		table
	}
}
?>