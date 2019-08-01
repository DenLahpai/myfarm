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
    $page_title = 'Post Nnan';
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
                <!-- new_post -->
                <div class="new_post">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <ul>
                            <li>
                                Mari / Dut:
                                <select name="SellBuy" id="SellBuy">
                                    <option value="">Langai lata na</option>
                                    <option value="1">Mari Na</option>
                                    <option value="2">Dut Na</option>
                                </select>
                            </li>
                            <li>
                                <input type="text" name="Subject" id="Subject" placeholder="Ga baw">
                            </li>
                            <li>
                                <textarea name="description" placeholder="Shiga"></textarea>
                            </li>
                            <li class="error">
                                <?php
                                if (!empty($error)) {
                                    echo $error;
                                }
                                ?>
                            </li>
                            <li>
                                <button type="submit" name="buttonSubmit" id="buttonSubmit" onclick="checkTwoFields('SellBuy', 'Subject');">Post galaw</button>
                            </li>
                        </ul>
                    </form>
                </div>
                <!-- end of new_post -->
            </main>
        </div>
        <!-- end of content -->
    </body>
    <script type="text/javascript" src="../scripts/scripts.js"></script>
    <script type="text/javascript" src="../scripts/modals.js"></script>
</html>
