<?php 
require_once "../../functions.php";
if (isset($_POST['ReportedItem']) && isset($_POST['SendersRemark'])) {
   

    //getting UsersLink
    $rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL);
    foreach ($rows_Users as $row_Users) {
     # code...
    }
    echo $link = table_Reports ('insert', $row_Users->Link , NULL, NULL, NULL);
}
else {
    echo 'Nope';
}

?>