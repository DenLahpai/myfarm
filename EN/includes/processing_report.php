<?php 
require_once "../../functions.php";
if (isset($_POST['ReportedItem']) || isset($_POST['SendersRemark'])) {
    echo $_POST['SendersRemark'];
}
//TODO
?>