<?php
require_once "../../functions.php";
if (isset($_POST['PostsLink']) || !empty($_POST['PostsLink']) || $_POST['PostsLink'] != "") {
    if (isset($_SESSION['UsersId'])) {
        //getting Users Link
        $rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL, NULL);
        foreach ($rows_Users as $row_Users) {
            #code...
        }
        table_Bookmarks ('insert', $row_Users->Link, NULL);
    }
}
?>