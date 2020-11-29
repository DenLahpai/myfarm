<?php  
require_once "../../functions.php";

if (!isset($_POST['Email'])) {
	echo 1;
}
else {
	//checking if the user's email is correct
	$rowCount = table_Users ('check_email_for_password_reset', $_POST['Email'], NULL);

	if ($rowCount == 0) {
		echo 'Ndai email hte jahpan bang da ai masha nnga ai! '.$_POST['Email']."<br>";
		echo "Kaga lam hku na chyam yu na matu <a href='forgot_password2.html'>nang kaw dip ya rit</a>.";
	}
	else {
		//resting password by user email
		$new_password = table_Users ('reset_password_by_user_email', $_POST['Email'], NULL);

		if (isset($new_password)) {
			//sending new password by email
			$mail_header = "FROM: No Reply <noreply@mydomain.com>\r\n";
			$mail_header .= "Content-type: text/html\r\n";
			$subject = "Password Reset";
			$message = "Na password nnan: ".$new_password;
			if (mail($_POST['Email'], $subject, $message, $mail_header)) {
				//zeror for no error!
				echo 0;
			}
			else {
				// one is retruned for connection error!
				echo 1;
			}	
		}
	}
}

?>
