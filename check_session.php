<?php
require_once "functions.php";

if (!isset($_SESSION['UsersName'])) {
    echo 0;
}
else {
    echo $_SESSION['UsersName'];
}
?>
