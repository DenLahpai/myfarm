<?php  
require_once "../../functions.php";
$rows_Tags = table_Tags('select_all', NULL, NULL, 'ORDER BY English ASC');
$_POST['selectedId'];
foreach ($rows_Tags as $row_Tags) {
	if ($row_Tags->Id == $_POST['selectedId']) {
		echo "<option value=\"$row_Tags->Id\" selected>".$row_Tags->English."</option>";
	}
	else {
		echo "<option value=\"$row_Tags->Id\">".$row_Tags->English."</option>";
	}
}
?>