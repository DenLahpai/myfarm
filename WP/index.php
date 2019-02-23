<?php
function error($msg) {
    echo "<script>";
    echo "alert(\"$msg\");";
    echo "</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error('test');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "Welcome";
    include "includes/head.html";
    ?>
    <body>
        <?php include "includes/menu-bar.html"; ?>
        <!-- content -->
        <div class="content">
            <?php
            $header = "Shiga Ningnan";
            include "includes/header.html";
            include "includes/nav.html";
            ?>
            <main>
                <!-- grid-div -->
                <div class="grid-div">

                </div>
                <!-- end of grid-div -->
            </main>
        </div>
        <!-- end of content -->
        <?php include "includes/footer.html"; ?>
    </body>
    <script type="text/javascript" src="../scripts/scripts.js"></script>
    <script type="text/javascript" src="../scripts/modals.js"></script>
</html>
