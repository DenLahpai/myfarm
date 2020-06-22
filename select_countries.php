<?php
require_once "functions.php";

$database = new Database();
$query = "SELECT * FROM Countries ORDER BY Id ;";
$database->query($query);
$rows = $database->resultset();

foreach ($rows as $row) {
    echo "<option value=\"$row->CountryCode\">".$row->Country."</option>";
}
?>