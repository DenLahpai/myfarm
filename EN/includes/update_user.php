<?php  
require_once "../../functions.php";

if (isset($_POST)) {
	table_Users ('update', $_SESSION['UsersId'], NULL);
}
?>