<?php  
require_once "../../functions.php";

if (isset($_POST['Link'])) {
	table_Users_Notifications ('delete_one', $_POST['Link'], NULL, NULL, NULL);
}
?>