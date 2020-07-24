<?php
require_once "../functions.php";

$database = new Database();

$query = "SELECT * FROM Users
    WHERE Username = :Username
    AND BINARY Password = :Password
;";
$database->query($query);
$database->bind(":Username", $_POST['Username']);
$database->bind(":Password", md5($_POST['Password']));
$rowCount = $database->rowCount();
if ($rowCount == 0) {
    echo $rowCount;
}
else {
    $rows = $database->resultset();
    foreach ($rows as $row) {
        $_SESSION['UsersId'] = $row->Id;
        $_SESSION['Username'] = $row->Username;
        $_SESSION['Link'] = $row->Link;
        echo $rowCount;        
    }
}
?>
