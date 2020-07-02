<?php
require_once "../../functions.php";
if(isset($_POST['Comment'])) {
   //getting PostsLink
   $rows_Posts = table_Posts ('select_one', $_POST['PostsId'], NULL, NULL, NULL);
   foreach ($rows_Posts as $row_Posts) {
       #code...
   }
   //getting UsersLink
   $rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL);
   foreach ($rows_Users as $row_Users) {
       # code...
   }
   //inserting data
   table_Comments ('insert', $row_Posts->Link, $row_Users->Link, NULL, NULL, NULL);
}
?>