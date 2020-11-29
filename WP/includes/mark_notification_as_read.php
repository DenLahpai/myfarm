<?php  
require_once "../../functions.php";

if (isset($_POST['Link'])) {
	table_Users_Notifications ('mark_as_read', $_POST['Link'], NULL, NULL, NULL);
}
?>
