<?php  
require_once "../../functions.php";

//getting data from the table Users 
$rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL);
foreach ($rows_Users as $row_Users) {
	# code ...
}
table_Messages ('reply', $row_Users->Link, $_POST['ConversationId'], NULL, NULL, NULL);

?>