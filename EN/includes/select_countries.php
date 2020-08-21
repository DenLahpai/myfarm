<?php  
require_once "../../functions.php";

//getting data from the table Countries
$rows_Countries = table_Countries ('select_all', NULL, NULL);
foreach ($rows_Countries as $row_Countries) {
	echo "<option value=\"$row_Countries->Id\">".$row_Countries->Country."</option>";
}
?>