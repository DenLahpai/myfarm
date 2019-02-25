<?php
require_once "../functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rowCount = table_Users('check_before_insert', NULL, NULL);
    if ($rowCount == 0) {
        table_Users('insert', NULL, NULL);
    }
    else {
        $error = "You are already registered! Please contact us if you wish to recover your account!";
    }

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = 'Signup';
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
                <!-- signup form -->
                <div class="form">
                    <form action="#" method="post" id="signup">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">Please signup to use our platform.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Title:
                                    </td>
                                    <td>
                                        <select name="Title">
                                            <option value="Mr.">Mr.</option>
                                            <option value="Ms.">Ms.</option>
                                            <option value="Mrs.">Mrs.</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Name:
                                    </td>
                                    <td>
                                        <input type="text" name="Name" id="Name" placeholder="Name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mobile:
                                    </td>
                                    <td>
                                        <input type="text" name="Mobile" id="MobileNo" placeholder="Mobile No" onchange="checkNumber('MobileNo', 'EN');">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Choose a Password:
                                    </td>
                                    <td>
                                        <input type="text" name="choosePassword" id="choosePassword" placeholder="Password">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Repeat Password:
                                    </td>
                                    <td>
                                        <input type="text" name="repeatPassword" id="repeatPassword" placeholder="Repeat Password" onchange="checkPasswords('choosePassword', 'repeatPassword','EN');">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Date of Birth:
                                    </td>
                                    <td>
                                        <input type="date" name="DOB" id="DOB">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Address:
                                    </td>
                                    <td>
                                        <input type="text" name="Address" id="Address" placeholder="Address">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Town:
                                    </td>
                                    <td>
                                        <input type="text" name="Town" id="Town" placeholder="Town">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        State:
                                    </td>
                                    <td>
                                        <input type="text" name="State" id="State" placeholder="State / Division" onchange="signup('EN');">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Country:
                                    </td>
                                    <td>
                                        <input type="text" name="Country" id="Country" value="Myanmar">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="error" colspan="2">
                                        <?php
                                        if (!empty($error)) {
                                            echo $error;
                                        }
                                        ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <button type="submit" name="buttonSubmit" id="buttonSignup" disabled>Signup Now</button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <!-- end of signup form -->
            </main>
        </div>
        <!-- end of content -->
        <?php include "includes/footer.html"; ?>
    </body>
    <script type="text/javascript" src="../scripts/scripts.js"></script>
    <script type="text/javascript" src="../scripts/modals.js"></script>
</html>
