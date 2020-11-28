<?php
require_once "../../functions.php";
if (isset($_POST['BookmarksId']) || !empty($_POST['BookmarksId']) || $_POST['BookmarksId'] != "") {
    table_Bookmarks ('remove_bookmark', $_POST['BookmarksId'], NULL);
}
?>