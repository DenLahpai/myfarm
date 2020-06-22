<?php
require_once "functions.php";

if (!isset($_SESSION['UsersId'])) {
    echo 0;
}
else {
    echo $_SESSION['Username'];
}
?>
