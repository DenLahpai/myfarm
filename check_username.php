<?php 
require_once "functions.php";
$rowCount = table_Users ('check_before_insert', NULL, NULL, NULL, NULL);
if ($rowCount == 0) {
	//No duplications and returning the rowCount 0. 
	echo $rowCount;
}
else {
	// Duplicate entry and returning the rowCount which is greater than 0.
	echo $rowCount;
}
?>