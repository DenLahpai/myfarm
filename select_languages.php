<?php
require_once "functions.php";
$selected = $_GET['selected'];

# getting data from the table Languages 
$database = new Database();

$query = "SELECT * FROM Languages ORDER BY Id ;";
$database->query($query);
$rows = $database->resultset();
foreach ($rows as $row) {
    if ($selected == $row->Id) {
        echo "<option value=\"$row->Id\" selected>".$row->Language."</option>";
    }
    else {
        echo "<option value=\"$row->Id\">".$row->Language."</option>";
    }
}

?>