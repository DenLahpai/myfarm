<?php
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "Welcome";
    include "includes/head.html";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <!-- login form -->
            <div class="login form">
                <form action="login.php" method="post">
                    <ul>
                        <li>
                            Mobile No:
                            <input type="text" name="Mobile" id="Mobile" placeholder="0943243242">
                        </li>
                        <li>
                            Password:
                            <input type="password" name="Password" id="Password" placeholder="******">
                        </li>
                        <button type="button" name="buttonLogin" id="buttonLogin" onclick="checkTwoFields('Mobile', 'Password');">Login</button>
                        <li class="error">

                        </li>
                    </ul>
                </form>
            </div>
            <!-- login form -->
        </div>
        <!-- end of content -->
    </body>
    <script type="text/javascript" src="scripts/scripts.js"></script>
</html>
