<?php  
require_once "../../functions.php";

if (isset($_POST['Old_Password']) && isset($_SESSION['UsersId'])) {
	$rowCount = table_Users ('check_current_password', NULL, NULL);
	
	if ($rowCount == 1) {
		if (isset($_POST['Password1']) && isset($_POST['Password2'])) {
			if ($_POST['Password1'] == $_POST['Password2']) {
				echo table_Users ('update_password', NULL, NULL);
			}			
		}		
	}
	else {
		// Msg 'Wrong Password' in case incorrect password is entered
		echo 'Wrong Password';
	}
}


?>