<?php
require_once "../functions.php";
//checking if the email is NULL
if (!empty($_POST['Email'])) {
	if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)){
		echo "Please enter a valid email address!";
	}
	else {
		table_Users('insert', NULL, NULL, NULL, NULL);
	}
}
else {
	table_Users('insert', NULL, NULL, NULL, NULL);
}
?>