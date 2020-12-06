<?php 
require_once "../../functions.php";

if (!isset($_POST['Id']) || empty($_POST['Id'])) {
    echo "There was a connection problem! Please try again!";
}
else {
    table_Posts ('delete_post', $_POST['Id'], NULL, NULL, NULL);
}
?>