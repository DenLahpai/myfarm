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

		//Inserting notification to Comment onwer
		$receivers_link = $row_Comments->UsersLink;
		$post_link = $row_Comments->PostsLink;
		table_Users_Notifications ('insert_reply_nfc_to_commenter', $row_Comments->UsersLink, $row_Comments->PostsLink, NULL, NULL);

		//getting the post owner
		$rows_Posts = table_Posts ('select_one_by_link', $row_Comments->PostsLink, NULL, NULL, NULL);
		foreach ($rows_Posts as $row_Posts) {
			# code...
		}

		//Inserting notification to Post Owner
		table_Users_Notifications ('insert_reply_nfc_to_post_owner', $row_Posts->UsersLink, $row_Posts->Link, NULL, NULL);	
		
	}
}
?>