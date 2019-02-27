<?php
require_once "../functions.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rowCount = table_Users('login', NULL, NULL);
    if ($rowCount < 1) {
        $error = 'Wrong Mobile No or Password!';
    }
    else {
        header("location:start_session.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = 'Login';
    include "includes/head.html";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <?php
            $header = "Signup";
            include "includes/header.html";
            include "includes/menu-bar.html";
            include "includes/nav.html";
            ?>
            <main>
                <!-- login form -->
                <div class="form" id="loginForm">
                    <form action="login.php" method="post">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">Please Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Mobile No:
                                    </td>
                                    <td>
                                        <input type="text" name="Mobile" id="Mobile" placeholder="0943243242">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Password:
                                    </td>
                                    <td>
                                        <input type="password" name="Password" id="Password" placeholder="******">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="error">
                                        <?php
                                        if (!empty($error)) {
                                            echo $error;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <button type="button" name="buttonLogin" id="buttonLogin" onclick="checkTwoFields('Mobile', 'Password', 'EN');">Login</button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <!-- login form -->
            </main>
        </div>
        <!-- end of content -->
    </body>
    <script type="text/javascript" src="../scripts/scripts.js"></script>
    <script type="text/javascript" src="../scripts/modals.js"></script>
</html>
