<?php  
require_once "../../functions.php";

//getting data from the table Languages
$rows_Languages = table_Languages ('select_all', NULL, NULL);
foreach ($rows_Languages as $row_Languages) {
	if ($row_Languages->Id == $_POST['selected']) {
		echo "<option value=\"$row_Languages->Id\" selected>".$row_Languages->Language."</option>";
	}
	else {
		echo "<option value=\"$row_Languages->Id\">".$row_Languages->Language."</option>";
	}
}
?>