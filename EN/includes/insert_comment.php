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
    //inserting data to the table Comments
    $CommentsLink = table_Comments ('insert', $row_Posts->Link, $row_Users->Link, NULL, NULL, NULL);

    if ($CommentsLink != 1) {
        //updating the table Posts
        table_Posts ('update_time', $_POST['PostsId'], NULL, NULL, NULL, NULL);

        //creating a notification to the post owner

        //getting data UsersLink of the post Owner. 
        $rows_posts_owner = table_Users ('select_one', $row_Posts->UsersId, NULL);
        foreach ($rows_posts_owner as $row_posts_owner) {
           // codes
        }

        //getting all the commenters of the post
        $rows_Commenters = table_Comments ('select_for_commenters', $row_Posts->Link, NULL, NULL, NULL);
        
        foreach ($rows_Commenters as $row_Commenters) {
            //inserting data to notify all the commenters
            table_Users_Notifications ('insert_nfc_to_all_commenters', $row_Commenters->UsersLink, $Comments_LogsLink, NULL, NULL);
        }

        //inserting data to the table Users_Notifications
        // Notification for the post owner
        table_Users_Notifications ('insert_nfc_to_post_owner', $row_posts_owner->Link, $row_Posts->Link, NULL, NULL);

    }   
}
?>