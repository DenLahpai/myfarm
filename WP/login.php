<?php
require_once "../functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $Mobile = trim($_REQUEST['Mobile']);
    $Password = trim ($_REQUEST['Password']);
    $query = "SELECT * from Users
        WHERE BINARY Mobile = :Mobile
        AND BINARY Password = :Password ;";
    $database->query($query);
    $database->bind(':Mobile', $Mobile);
    $database->bind(':Password', $Password);
    $rowCount = $database->rowCount();

    if ($rowCount == 0) {
        $error = 'Wrong Mobile Number or Password! Please contact us to retrieve your login data!';
    }
    else {
        $rows_Users = $database->resultset();
        foreach ($rows_Users as $row_Users) {
            $_SESSION['Name'] = $row_Users->Name;
        }
        header("location:index.php");

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
                                    <th colspan="2">Login Galaw Ga</th>
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
                                        Ga Makoi:
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
