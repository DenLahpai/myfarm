<?php
require_once "../functions.php";

//checking if the user is loggedin
if (!isset($_SESSION['Name']) || empty($_SESSION['Name'])) {
    echo 'Login shawng galaw ga';
    die();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = 'Test';
    include "includes/head.html";
    ?>
    <body>
        <p>Teststingsfdsfdsfsd</p>
    </body>
</html>
