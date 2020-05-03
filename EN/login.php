<?php
require_once "../functions.php";

$database = new Database();

$query = "SELECT * FROM Users
    WHERE Mobile = :Mobile
    AND BINARY Password = :Password
;";
$database->query($query);
$database->bind(":Mobile", $_POST['Mobile']);
$database->bind(":Password", $_POST['Password']);
$rowCount = $database->rowCount();
if ($rowCount == 0) {
    echo $rowCount;
}
else {
    $rows = $database->resultset();
    foreach ($rows as $row) {
        $_SESSION['UsersId'] = $row->Id;
        $_SESSION['UsersName'] = $row->Name;
        echo $rowCount;        
    }
}
?>
