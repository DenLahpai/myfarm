<?php  
require_once "../../functions.php";


if (isset($_POST['Mobile'])) {
	$Message = "DOB: ".$_POST['DOB']."<br>";
	$Message .= "App: ".$_POST['app'];
	$database = new Database();
	$query = "INSERT INTO Messages2Admin SET 
		Name = :Name,
		Email = :Mobile,
		Message = :Message
	;";
	$database->query($query);
	$database->bind(':Name', trim($_POST['Name']));
	$database->bind(':Mobile', trim($_POST['Mobile']));
	$database->bind(':Message', $Message);
	if ($database->execute()) {
		$subject = "Request for Password Reset!";
		$mail_header = "FROM: <".$_POST['Name'].">\r\n";
        $mail_header .= "Content-type: text/html\r\n";
        mail ('den.lahpai@icloud.com', $subject, $Message, $mail_header);
        // zero is returned for no error!
        echo 0;
	}
	else {
		// one is returned for connection error!
		echo 1;
	}
}
?>
