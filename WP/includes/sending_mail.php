<?php  
require_once "../../functions.php";

//getting UsersLink
$rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL);
foreach ($rows_Users as $row_Users) {
 # code...
}

//inserting data to the table Messages 
$link = table_Messages ('insert', $row_Users->Link, NULL, NULL, NULL);

?>