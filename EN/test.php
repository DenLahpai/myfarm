<?php  
require_once "../functions.php";

$rows_Users = table_Tags('select_all', NULL, NULL, NULL);

foreach ($rows_Users as $row_Users) {
    print_r($row_Users);
}


?>