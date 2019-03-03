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
        <!-- content -->
        <div class="content">
            <main>
                <!-- new_post -->
                <div class="new_post">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <input type="file" name="Image" value="">
                        <input type="submit" name="" value="Upload">
                    </form>
                </div>
                <!-- end of new_post -->
            </main>
        </div>
        <!-- end of content -->
    </body>
</html>
