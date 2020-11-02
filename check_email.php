<?php  
require_once "functions.php";

if (empty($_REQUEST['Email'])) {
	echo 0;
}
else {
	echo $rowCount = table_Users ('check_email', NULL, NULL, NULL, NULL);
}

?>