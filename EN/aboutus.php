<?php
require_once "../functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "About Us";
    include "includes/head.html";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <?php
            $header = $page_title;
            include "includes/header.html";
            include "includes/menu-bar.html";
            include "includes/nav.html";
            ?>
            <main>
                <p> This platform is created in order to help you to trade your farm products.</p>
            </main>
        </div>
        <?php include "includes/footer.html"; ?>
        <!-- end of content -->
    </body>
    <script type="text/javascript" src="../scripts/scripts.js"></script>
    <script type="text/javascript" src="../scripts/modals.js"></script>
</html>
