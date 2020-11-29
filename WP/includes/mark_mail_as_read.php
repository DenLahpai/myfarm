<?php  
require_once "../../functions.php";

if (isset($_REQUEST['MessagesLink'])) {
	echo $r = table_Messages ('mark_as_read', $_REQUEST['MessagesLink'], NULL, NULL, NULL);	
}



?>
