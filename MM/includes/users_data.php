<?php
require_once "../../functions.php";
if (isset($_POST['UsersLink']) || !empty($_POST['UsersLink']) || $_POST['UsersLink'] != "") {
    $data = $_POST['fetch_data'];
    //getting data from the table Users
    $rows_Users = table_Users ('select_one_by_link', $_POST['UsersLink'], NULL, NULL, NULL);
    foreach ($rows_Users as $row_Users) {
        echo $row_Users->$data;
    }
}
else {
    die();
}
?>