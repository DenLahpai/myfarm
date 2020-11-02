<?php
require_once "conn.php";

//function to use data from the table Users
function table_Users($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'check_before_insert':

            $query = "SELECT Id FROM Users
                WHERE Username = :Username
            ;";
            $database->query($query);
            $database->bind(':Username', $_REQUEST['Username']);
            return $rowCount = $database->rowCount();
            break;

        case 'check_email':
            // getting data from the form
            $query =  "SELECT Id FROM Users
                WHERE Email = :Email
            ;";
            $database->query($query);
            $database->bind(':Email', $_REQUEST['Email']);
            return $rowCount = $database->rowCount();
            break;

        case 'insert':
            //getting data from the form
            $Username = trim($_REQUEST['Username']);
            $Link = md5($Username);
            $Mobile = trim($_REQUEST['Mobile']);
            $Email = trim($_REQUEST['Email']);
            $Password = trim($_REQUEST['Password1']);
            $Title = $_REQUEST['Title'];
            $Name = trim($_REQUEST['Name']);
            $DOB = $_REQUEST['DOB'];
            $Address = trim($_REQUEST['Address']);
            $Town = trim($_REQUEST['Town']);
            $State = trim($_REQUEST['State']);
            $CountryCode = trim($_REQUEST['CountryCode']);
            $LanguagesId = trim($_REQUEST['LanguagesId']);
            $query = "INSERT INTO Users SET
                Username = :Username,
                Link = :Link,
                Password = :Password,
                Title = :Title,
                Name = :Name,
                Mobile = :Mobile,
                Email = :Email,
                DOB = :DOB,
                Address = :Address,
                Town = :Town,
                State = :State,
                CountryCode = :CountryCode,
                LanguagesId  = :LanguagesId,
                Status = :Status
            ;";
            $database->query($query);
            $database->bind(':Username', $Username);
            $database->bind(':Link', $Link);
            $database->bind(':Password', md5($Password));
            $database->bind(':Mobile', $Mobile);
            $database->bind(':Email', $Email);
            $database->bind(':Title', $Title);
            $database->bind(':Name', $Name);
            $database->bind(':DOB', $DOB);
            $database->bind(':Address', $Address);
            $database->bind(':Town', $Town);
            $database->bind(':State', $State);
            $database->bind(':CountryCode', $CountryCode);
            $database->bind(':LanguagesId', $LanguagesId);
            $database->bind(':Status', 1);
            if ($database->execute()) {
                // if no error zero is returned
                echo 0;
            }
            else {
                // 1 is returned for connection error!
                echo 1;
            }
            break;

        case 'check_current_password':
            $query = "SELECT * FROM Users
                WHERE Password = :Password
                AND Id = :UsersId
            ;";
            $database->query($query);
            $database->bind(':Password', md5($_POST['Old_Password']));
            $database->bind(':UsersId', $_SESSION['UsersId']);
            return $r = $database->rowCount();
            break;

        case 'update_password':
            $query = "UPDATE Users SET
                Password = :Password
                WHERE Id = :UsersId
            ;";
            $database->query($query);
            $database->bind(':Password', md5($_POST['Password1']));
            $database->bind(':UsersId', $_SESSION['UsersId']);
            if ($database->execute()) {
                // Zero is returned for no error!
                echo 0;
            }
            else {
                // 1 is returned for connection error!
                echo 1;
            }
            break;

        case 'select_one':
            # $var1 = UsersId
            $query = "SELECT * FROM Users WHERE Id = :UsersId ;";
            $database->query($query);
            $database->bind(':UsersId', $var1);
            return $r = $database->resultset();
            break;

        case 'update':
            # $var1 = UsersId
            $query = "UPDATE Users SET
                Title = :Title,
                Name = :Name,
                Mobile = :Mobile,
                Email = :Email,
                DOB = :DOB,
                Address = :Address,
                Town = :Town,
                State = :State,
                CountryCode = :CountryCode
                WHERE Id = :UsersId
            ;";
            $database->query($query);
            $database->bind(':Title', trim($_POST['Title']));
            $database->bind(':Name', trim($_POST['Name']));
            $database->bind(':Mobile', trim($_POST['Mobile']));
            $database->bind(':Email', trim($_POST['Email']));
            $database->bind(':DOB', $_POST['DOB']);
            $database->bind(':Address', trim($_POST['Address']));
            $database->bind(':Town', trim($_POST['Town']));
            $database->bind(':State', trim($_POST['State']));
            $database->bind(':CountryCode', trim($_POST['CountryCode']));
            $database->bind(':UsersId', $var1);
            if ($database->execute()) {
                // zero is returned for no error!
                echo 0;
            }
            else {
                // 1 is returned for connection error!
                echo 1;
            }
            break;

        case 'select_one_by_link':
            # $var1 = $Link
            $query = "SELECT * FROM Users WHERE Link = :Link ;";
            $database->query($query);
            $database->bind(':Link', $var1);
            return $r = $database->resultset();
            break;

        case 'check_email_for_password_reset':
            # var1 = $Email
            $query = "SELECT * FROM Users WHERE Email = :Email ;";
            $database->query($query);
            $database->bind(':Email', $var1);
            return $r = $database->rowCount();
            break;

        case 'reset_password_by_user_email':
            #$var1 = Email;
            $Password = 'goodluck'.date('d');
            $query = "UPDATE Users SET
                Password = :Password
                WHERE Email = :Email
            ;";
            $database->query($query);
            $database->bind(':Password', md5($Password));
            $database->bind(':Email', $var1);
            if ($database->execute()) {
                return $Password;
            }
            break;
        default:
            // code...
            break;
    }
}

//functions to use data from the table Tags
function table_Tags ($job, $var1, $var2, $sorting) {
    $database = new Database();

    switch ($job) {
        case 'select_all':
            $query = "SELECT * FROM Tags $sorting ;";
            $database->query($query);
            return $r = $database->resultset();
            break;

        case 'select_one':
            # $var1 = TagsId
            $query = "SELECT * FROM Tags WHERE Id = :TagsId ;";
            $database->query($query);
            $database->bind(':TagsId', $var1);
            return $r = $database->resultset();
            break;

        default:
            # code...
            break;
    }
}

// function to use dat from the table Posts
function table_Posts ($job, $var1, $var2, $sorting, $limit) {
    $database = new Database();

    switch ($job) {
        case 'insert':
            # creating link
            $Link = uniqid('post_link', true);
            $query = "INSERT INTO Posts SET
                Link = :Link,
                Title = :Title,
                Description = :Description,
                TagsId = :TagsId,
                UsersId = :UsersId
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':Title', trim($_GET['Title']));
            $database->bind(':Description', trim($_GET['Description']));
            $database->bind(':TagsId', $_GET['TagsId']);
            $database->bind(':UsersId', $_SESSION['UsersId']);
            if ($database->execute()) {
                return $Link;
            }
            else {
                echo 1;
                die();
            }

            break;

        case 'select_all':
            $query = "SELECT
                Posts.Id,
                Posts.Link,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status,
                Posts.UsersId,
                Posts.Created,
                Posts.Updated,
                Tags.Jinghpaw,
                Tags.English,
                Tags.Burmese
                FROM Posts LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                LEFT OUTER JOIN Users
                ON Posts.UsersId = Users.Id
                WHERE Posts.Status != 0 $sorting LIMIT $limit ;";
            $database->query($query);
            return $r = $database->resultset();
            break;

        case 'rowCount':
            $query = "SELECT * FROM Posts ;";
            $database->query($query);
            return $r = $database->rowCount();
            break;

        case 'search':
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Posts.Id,
                Posts.Link,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status,
                Posts.UsersId,
                Posts.Created,
                Posts.Updated,
                Tags.Jinghpaw,
                Tags.English,
                Tags.Burmese
                FROM Posts LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                LEFT OUTER JOIN Users
                ON Posts.UsersId = Users.Id
                WHERE CONCAT(
                Users.Username,
                Posts.Title,
                Posts.Description,
                Tags.English,
                Tags.Jinghpaw,
                Tags.Burmese
                ) LIKE :search
                AND Posts.Status != 0
                $sorting LIMIT $limit
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            return $r = $database->resultset();
            break;

        case 'search_rowCount':
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Posts.Id,
                Posts.Link,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status,
                Posts.UsersId,
                Posts.Created,
                Posts.Updated,
                Tags.Jinghpaw,
                Tags.English,
                Tags.Burmese
                FROM Posts LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                LEFT OUTER JOIN Users
                ON Posts.UsersId = Users.Id
                WHERE CONCAT(
                Users.Username,
                Posts.Title,
                Posts.Description,
                Tags.English,
                Tags.Jinghpaw,
                Tags.Burmese
                ) LIKE :search
                AND Posts.Status != 0
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            return $r = $database->rowCount();
            break;

        case 'select_one':
            # $var1 = PostId
            $query = "SELECT * FROM Posts WHERE Id = :PostsId ;";
            $database->query($query);
            $database->bind(':PostsId', $var1);
            return $r = $database->resultset();
            break;

        case 'select_one_by_link':
            # $var1 = PostsLink
            $query = "SELECT
                Posts.Id,
                Posts.Link,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status AS Status,
                Posts.UsersId,
                Posts.Created,
                Posts.Updated,
                Users.Link AS UsersLink
                FROM Posts
                LEFT OUTER JOIN Users
                ON Posts.UsersId = Users.Id
                WHERE Posts.Link = :PostsLink

            ;";
            $database->query($query);
            $database->bind(':PostsLink', $var1);
            return $r = $database->resultset();
            break;

        case 'mark_as_sold_out':
            # $var1 = PostsId
            $query = "UPDATE Posts SET
                Status = 3
                WHERE Id = :PostsId
            ;";
            $database->query($query);
            $database->bind(':PostsId', $var1);
            if ($database->execute()) {
                // zero is returned as there is no error!
                echo 0;
            }
            else {
                // 1 is returned as there is a connection error!
                echo 1;
            }
            break;

        case 'select_one_user_posts':
            # $var1 = UsersId
            $query = "SELECT * FROM Posts WHERE UsersId = :UsersId AND Posts.Status != 0 $sorting LIMIT $limit ;";
            $database->query($query);
            $database->bind(':UsersId', $var1);
            return $r = $database->resultset();
            // echo $query;
            break;

        case 'search_one_user_posts':
            # $var1 = UsersId
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Posts.Id,
                Posts.Link,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status,
                Posts.UsersId,
                Posts.Created,
                Posts.Updated,
                Tags.Jinghpaw,
                Tags.English,
                Tags.Burmese
                FROM Posts LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                WHERE CONCAT(
                Posts.Title,
                Posts.Description,
                Tags.English,
                Tags.Jinghpaw,
                Tags.Burmese
                ) LIKE :search
                AND Posts.Status != 0
                AND UsersId = :UsersId
                $sorting LIMIT $limit
             ;";
            $database->query($query);
            $database->bind(':UsersId', $var1);
            $database->bind(':search', $search);
            return $r = $database->resultset();
            break;

        case 'rowCount_one_user_posts':
            # $var1 = UsersId
            $query = "SELECT * FROM Posts WHERE UsersId = :UsersId ;";
            $database->query($query);
            $database->bind(':UsersId', $var1);
            return $r = $database->rowCount();
            break;

        case 'search_one_user_posts_rowCount':
            # $var1 = UsersId
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Posts.Id,
                Posts.Link,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status,
                Posts.UsersId,
                Posts.Created,
                Posts.Updated,
                Tags.Jinghpaw,
                Tags.English,
                Tags.Burmese
                FROM Posts LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                WHERE CONCAT(
                Posts.Title,
                Posts.Description,
                Tags.English,
                Tags.Jinghpaw,
                Tags.Burmese
                ) LIKE :search
                AND Posts.Status != 0
                AND UsersId = :UsersId
            ;";
            $database->query($query);
            $database->bind(':UsersId', $var1);
            $database->bind(':search', $search);
            return $r = $database->rowCount();
            break;

        case 'delete_post':
            # $var1 = PostsId
            $query =  "UPDATE Posts SET Status = 0 WHERE Id = :Id ;";
            $database->query($query);
            $database->bind(':Id', $var1);
            if ($database->execute()) {
                // 0 is returned as 0 error!
                echo 0;
            }
            else {
                // 1 is returned for connection error
                echo 1;
            }
            break;

        case 'select_bookmarks':
            #var1 = Link
            $query = "SELECT
                Bookmarks.Id AS BookmarksId,
                Bookmarks.PostsLink,
                Bookmarks.UsersLink,
                Bookmarks.Status AS BookmarksStatus,
                Bookmarks.Created AS BookmarksCreated,
                Bookmarks.Updated AS BookmarksUpdated,
                Posts.Id AS PostsId,
                Posts.Title,
                Posts.Link,
                Posts.Description,
                Posts.TagsId,
                Posts.Status AS PostsStatus,
                Posts.UsersId,
                Posts.Created AS PostsCreated,
                Posts.Updated AS PostsUpdated
                FROM Bookmarks
                INNER JOIN Posts
                ON Bookmarks.PostsLink = Posts.Link
                LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                WHERE Bookmarks.UsersLink = :UsersLink
                AND Bookmarks.Status != 0
                AND Posts.Status != 0
                $sorting LIMIT $limit
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();
            break;

        case 'rowCount_bookmarks':
            #var1 = UsersLink
            $query = "SELECT
                Bookmarks.Id AS BookmarksId,
                Bookmarks.PostsLink,
                Bookmarks.UsersLink,
                Bookmarks.Status AS BookmarksStatus,
                Bookmarks.Created AS BookmarksCreated,
                Bookmarks.Updated AS BookmarksUpdated,
                Posts.Id AS PostsId,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status AS PostsStatus,
                Posts.UsersId,
                Posts.Created AS PostsCreated,
                Posts.Updated AS PostsUpdated
                FROM Bookmarks
                INNER JOIN Posts
                ON Bookmarks.PostsLink = Posts.Link
                LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                WHERE Bookmarks.UsersLink = :UsersLink
                AND Bookmarks.Status != 0
                AND Posts.Status != 0
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->rowCount();
            break;

        case 'search_bookmarks':
            #var1 = UsersLink
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Bookmarks.Id AS BookmarksId,
                Bookmarks.PostsLink,
                Bookmarks.UsersLink,
                Bookmarks.Status AS BookmarksStatus,
                Bookmarks.Created AS BookmarksCreated,
                Bookmarks.Updated AS BookmarksUpdated,
                Posts.Id AS PostsId,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status AS PostsStatus,
                Posts.UsersId,
                Posts.Created AS PostsCreated,
                Posts.Updated AS PostsUpdated
                FROM Bookmarks
                INNER JOIN Posts
                ON Bookmarks.PostsLink = Posts.Link
                LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                WHERE CONCAT(
                    Posts.TItle,
                    Posts.Description,
                    Posts.TagsId,
                    Tags.English,
                    Tags.Jinghpaw,
                    Tags.Burmese
                ) LIKE :search
                AND Bookmarks.UsersLink = :UsersLink
                AND Bookmarks.Status != 0
                AND Posts.Status != 0
                $sorting LIMIT $limit
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();

        case 'search_bookmark_rowCount':
            #var1 = UsersLink
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Bookmarks.Id AS BookmarksId,
                Bookmarks.PostsLink,
                Bookmarks.UsersLink,
                Bookmarks.Status AS BookmarksStatus,
                Bookmarks.Created AS BookmarksCreated,
                Bookmarks.Updated AS BookmarksUpdated,
                Posts.Id AS PostsId,
                Posts.Title,
                Posts.Description,
                Posts.TagsId,
                Posts.Status AS PostsStatus,
                Posts.UsersId,
                Posts.Created AS PostsCreated,
                Posts.Updated AS PostsUpdated
                FROM Bookmarks
                INNER JOIN Posts
                ON Bookmarks.PostsLink = Posts.Link
                LEFT OUTER JOIN Tags
                ON Posts.TagsId = Tags.Id
                WHERE CONCAT(
                    Posts.TItle,
                    Posts.Description,
                    Posts.TagsId,
                    Tags.English,
                    Tags.Jinghpaw,
                    Tags.Burmese
                ) LIKE :search
                AND Bookmarks.UsersLink = :UsersLink
                AND Bookmarks.Status != 0
                AND Posts.Status != 0
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            $database->bind(':UsersLink', $var1);
            return $r = $database->rowCount();

        case 'update_time':
            # var1 = PostsId
            $query = "UPDATE Posts SET
                Updated = NOW()
                WHERE Link = :PostsLink
            ;";
            $database->query($query);
            $database->bind(":PostsLink", $var1);
            $database->execute();
            break;

        default:
            # code...
            break;
    }
}

// function to create thumbnail
function CreateThumbnail($pic,$thumb,$thumbwidth, $quality = 100) {
    $im1=ImageCreateFromJPEG($pic);

    if(function_exists("exif_read_data")){
        $exif = exif_read_data($pic);
        if(!empty($exif['Orientation'])) {

            switch($exif['Orientation']) {
            case 8:
                $im1 = imagerotate($im1,90,0);
                break;
            case 3:
                $im1 = imagerotate($im1,180,0);
                break;
            case 6:
                $im1 = imagerotate($im1,-90,0);
                break;
            }
        }
    }
    $info = @getimagesize($pic);

    $width = $info[0];

    $w2=ImageSx($im1);
    $h2=ImageSy($im1);
    $w1 = ($thumbwidth <= $info[0]) ? $thumbwidth : $info[0]  ;

    $h1=floor($h2*($w1/$w2));
    $im2=imagecreatetruecolor($w1,$h1);

    imagecopyresampled ($im2,$im1,0,0,0,0,$w1,$h1,$w2,$h2);
    $path=addslashes($thumb);
    ImageJPEG($im2,$path,$quality);
    ImageDestroy($im1);
    ImageDestroy($im2);
}

//function to use data from the table Images
function table_Images ($job, $var1, $var2, $sorting, $limit) {
    $database = new Database();
    switch ($job) {

        case 'insert':
            # $var1 = $link
            # $var2 = file_name
            $query = "INSERT INTO Images SET
                Name = :Name,
                PostsLink = :Link
            ;";
            $database->query($query);
            $database->bind(':Name', $var2);
            $database->bind(':Link', $var1);
            if ($database->execute()) {
                // zero is returned if there is no error!
                echo 0;
            }
            else {
                // 1 is returned if there is a connection error
                echo 1;
            }
            break;

        case 'select_for_one_post':
            # $var1 = PostsLink
            $query = "SELECT * FROM Images WHERE PostsLink = :PostsLink ORDER BY Updated;";
            $database->query($query);
            $database->bind(':PostsLink', $var1);
            return $r = $database->resultset();
            break;

        default:
            # code...
            break;
    }
}

//function to use data from the table Messages
function table_Messages ($job, $var1, $var2, $sorting, $limit) {
    $database = new Database();

    switch ($job) {
        case 'count_my_messages':
            # $var1 = UsersLink
            $query = "SELECT * FROM Messages
                WHERE ReceiversLink = :UsersLink
                AND Status != 0
                AND Unread = 1
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->rowCount();
            break;

        case 'select_my_messages':
            #$var1 = UsersLink
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE ReceiversLink = :UsersLink
                AND Messages.Status != 0
                $sorting LIMIT $limit
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();
            break;

        case 'rowCount_my_messages':
            // $var1 = UsersLink
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE ReceiversLink = :UsersLink
                AND Messages.Status != 0
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->rowCount();
            break;

        case 'search_my_messages':
            #$var1 = UsersLink
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE CONCAT(
                    Users.Username,
                    Messages.Subject,
                    Messages.Message
                ) LIKE :search
                AND ReceiversLink = :UsersLink
                $sorting LIMIT $limit
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();
            break;

        case 'rowCount_search_my_messages':
            #$var1 = UsersLink
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE CONCAT(
                    Users.Username,
                    Messages.Subject,
                    Messages.Message
                ) LIKE :search
                AND ReceiversLink = :UsersLink
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            $database->bind(':UsersLink', $var1);
            return $r = $database->rowCount();
            break;

        case 'select_my_sent_messages':
            #$var1 = UsersLink
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE SendersLink = :UsersLink
                AND Messages.Status != 0
                $sorting LIMIT $limit
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();
            break;

        case 'rowCount_my_sent_messages':
            #$var1 = UsersLink
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE SendersLink = :UsersLink
                AND Messages.Status != 0
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->rowCount();
            break;
        case 'search_my_sent_messages':
            #$var1 = UsersLink
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE CONCAT(
                    Users.Username,
                    Messages.Subject,
                    Messages.Message
                ) LIKE :search
                AND SendersLink = :UsersLink
                $sorting LIMIT $limit
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();
            break;

        case 'rowCount_search_my_sent_messages':
            #$var1 = UsersLink
            $search = '%'.$_POST['search'].'%';
            $query = "SELECT
                Messages.Id,
                Messages.Link,
                Messages.SendersLink,
                Messages.ReceiversLink,
                Messages.ConversationId,
                Messages.Subject,
                Messages.Message,
                Messages.Unread,
                Messages.Status,
                Messages.Created,
                Messages.Updated,
                Users.Username
                FROM Messages
                LEFT OUTER JOIN Users
                ON Messages.SendersLink = Users.Link
                WHERE CONCAT(
                    Users.Username,
                    Messages.Subject,
                    Messages.Message
                ) LIKE :search
                AND SendersLink = :UsersLink
            ;";
            $database->query($query);
            $database->bind(':search', $search);
            $database->bind(':UsersLink', $var1);
            return $r = $database->rowCount();
            break;

        case 'insert':
            # $var1 = UsersLink
            $Link = uniqid('msg_link', true);
            $ConversationId = uniqid('cvt_', true);
            $query = "INSERT INTO Messages SET
                Link = :Link,
                SendersLink = :SendersLink,
                ReceiversLink = :ReceiversLink,
                ConversationId = :ConversationId,
                Subject = :Subject,
                Message = :Message
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':SendersLink', $var1);
            $database->bind(':ReceiversLink', trim($_POST['ReceiversLink']));
            $database->bind(':ConversationId', $ConversationId);
            $database->bind(':Subject', trim($_POST['Subject']));
            $database->bind(':Message', trim($_POST['Message']));
            if ($database->execute()) {
                // zero is returned for no error
                echo 0;
            }
            else {
                // one is returned for connection error
                echo 1;
            }
            break;

        case 'reply':
            # $var1 = SendersLink
            $Link = uniqid('msg_link', true);
            $query = "INSERT INTO Messages SET
                Link = :Link,
                SendersLink = :SendersLink,
                ReceiversLink = :ReceiversLink,
                ConversationId = :ConversationId,
                Subject = :Subject,
                Message = :Message
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':SendersLink', $var1);
            $database->bind(':ReceiversLink', $_POST['ReceiversLink']);
            $database->bind(':ConversationId', $var2);
            $database->bind(':Subject', $_POST['Subject']);
            $database->bind(':Message', $_POST['Message']);
            if ($database->execute()) {
                // zero is returned for no error
                echo 0;
            }
            else {
                // one is returned for connection error
                echo 1;
            }
            break;

        case 'mark_as_read':
            # var1 = MessagesLink
            $query = "UPDATE Messages SET
                Unread = 0
                WHERE Link = :MessagesLink
            ;";
            $database->query($query);
            $database->bind(':MessagesLink', $var1);
            if ($database->execute()) {
                //zero is returned for no error
                return 0;
            }
            else {
                //one is returned for connection error
                return 1;
            }

            break;

        case 'select_one_by_link':
            #var1 = MessagesLink
            $query = "SELECT * FROM Messages WHERE Link = :MessagesLink ;";
            $database->query($query);
            $database->bind(':MessagesLink', $var1);
            return $r = $database->resultset();
            break;

        case 'get_one_conversation':
            # var1 = ConversationId
            # var2 = MessagesLink
            $query = "SELECT * FROM Messages
                WHERE ConversationId = :ConversationId
                AND Link != :MessagesLink
                ORDER BY Created DESC
            ;";
            $database->query($query);
            $database->bind(':ConversationId', $var1);
            $database->bind(':MessagesLink', $var2);
            return $r = $database->resultset();
            break;

        case 'delete':
            # var1 = MessagesLink
            $query = "UPDATE Messages SET
                Status = 0
                WHERE Link = :MessagesLink
            ;";
            $database->query($query);
            $database->bind(':MessagesLink', $var1);
            if ($database->execute()) {
                header("location: ../my_inbox.html");
            }
            break;

        default:
            # code...
            break;
    }
}

function table_Countries ($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'select_all':
            $query = "SELECT * FROM Countries ;";
            $database->query($query);
            return $r = $database->resultset();
            break;

        default:
            # code...
            break;
    }
}

//function to use data from the table Languages
function table_Languages ($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'select_all':
            $query = "SELECT * FROM Languages ;";
            $database->query($query);
            return $r = $database->resultset();
            break;

        default:
            # code...
            break;
    }
}

//function to use data from the table Favorites
function table_Bookmarks ($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {

        case 'insert':
            # var1 = UsersLink
            $query = "INSERT INTO Bookmarks SET
                PostsLink = :PostsLink,
                UsersLink = :UsersLink
            ;";
            $database->query($query);
            $database->bind(':PostsLink', $_POST['PostsLink']);
            $database->bind(':UsersLink', $var1);
            if ($database->execute()) {
                // Zero is returned if there is no error
                echo 0;
            }
            else {
                // One is returned for connection error
                echo 1;
            }
            break;

        case 'remove_bookmark':
            # var1 = BookmarksId
            $query = "UPDATE Bookmarks SET
                Status = 0
                WHERE Id = :BookmarksId
            ;";
            $database->query($query);
            $database->bind(':BookmarksId', $var1);
            if ($database->execute()) {
                // Zero is returned if there is no error!
                echo 0;
            }
            else {
                // One is returned for connection error!
                echo 1;
            }

        default:
            # code...
            break;
    }
}

//function to use data from the table Comments
function table_Comments ($job, $var1, $var2, $sorting, $limit) {
    $database = new Database();

    switch ($job) {
        case 'insert':
            # var1 = PostsLink
            # var2 = UsersLink
            //creating CommentsLink
            $Link = uniqid('comment_link', true);
            $query = "INSERT INTO Comments SET
                Link = :Link,
                PostsLink = :PostsLink,
                UsersLink = :UsersLink,
                Comment = :Comment
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':PostsLink', $var1);
            $database->bind(':UsersLink', $var2);
            $database->bind(':Comment', $_POST['Comment']);
            if ($database->execute()) {
                // Comments Link is returned if no error
                return $Link;
            }
            else {
                // one is returned for connection error
                echo 1;
            }
            break;

        case 'rowCount_Comments_for_one_post':
            #var1 = PostsLink
            $query = "SELECT * FROM Comments WHERE PostsLink = :PostsLink ORDER BY Updated;";
            $database->query($query);
            $database->bind(':PostsLink', $var1);
            return $r = $database->rowCount();
            break;

        case 'select_for_one_post':
            # var1 = PostsLink
            $query = "SELECT * FROM Comments WHERE PostsLink = :PostsLink ORDER BY Updated DESC;";
            $database->query($query);
            $database->bind(':PostsLink', $var1);
            return $r = $database->resultset();
            break;

        case 'select_one':
            #var1 = CommentsId
            $query = "SELECT * FROM Comments WHERE Id = :CommentsId ;";
            $database->query($query);
            $database->bind(':CommentsId', $var1);
            return $r = $database->resultset();
            break;

        case 'select_one_by_link':
            #var1 = CommentsLink
            $query = "SELECT * FROM Comments WHERE Link = :CommentsLink ;";
            $database->query($query);
            $database->bind(':CommentsLink', $var1);
            return $r = $database->resultset();
            break;

        case 'select_for_commenters':
            # $var1 = PostsLink
            # $var2 = PostOnwer
            $query = "SELECT DISTINCT UsersLink FROM Comments WHERE PostsLink = :PostsLink
                AND UsersLink != :UsersLink
            ;";
            $database->query($query);
            $database->bind(':PostsLink', $var1);
            $database->bind(':UsersLink', $var2);
            return $r = $database->resultset();
            break;

        default:
            # code...
            break;
    }
}

//function to use data from the table Replies
function table_Replies ($job, $var1, $var2, $sorting, $limit) {
    $database = new Database();

    switch ($job) {
        case 'insert':
            # var1 = $CommentsLink
            # var2 = $UsersLink
            # generating CommentsLink
            $Link = uniqid('reply_link', true);
            $query = "INSERT INTO Replies SET
                Link = :Link,
                CommentsLink = :CommentsLink,
                UsersLink = :UsersLink,
                Message = :Message
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':CommentsLink', $var1);
            $database->bind(':UsersLink', $var2);
            $database->bind(':Message', $_POST['Message']);
            if ($database->execute()) {
                // zero is returned for no error!
                echo 0;
            }
            else {
                // one is returned for connection error!
                echo 1;
            }
            break;

        case 'select_for_one_comment':
            #var1 = $CommentsLink
            $query = "SELECT * FROM Replies WHERE CommentsLink = :CommentsLink ;";
            $database->query($query);
            $database->bind(':CommentsLink', $var1);
            return $r = $database->resultset();
            break;

        case 'rowCount_replies_for_one_comment':
            # var1 = $CommentsLink
            $query = "SELECT * FROM Replies WHERE CommentsLink = :CommentsLink ;";
            $database->query($query);
            $database->bind(':CommentsLink', $var1);
            return $r = $database->rowCount();
            break;

        default:
            # code...
            break;
    }
}

//function to use data from the table Users_Notifications
function table_Users_Notifications ($job, $var1, $var2, $sorting, $limit) {

    $database = new Database();

    switch ($job) {
        case 'insert_nfc_to_post_owner':
            # $var1 = ReceiversLink
            # $var2 = PostsLink
            $Link = uniqid('usr_nfc', true);
            $Message = "commented on your post.";
            $query = "INSERT INTO Users_Notifications SET
                Link = :Link,
                ReceiversLink = :ReceiversLink,
                Message = :Message,
                PostsLink = :PostsLink,
                UsersLink = :UsersLink
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':ReceiversLink', $var1);
            $database->bind(':Message', $Message);
            $database->bind(':PostsLink', $var2);
            $database->bind(':UsersLink', $_SESSION['UsersLink']);
            if ($database->execute()) {
                // zero is returned for no error!
                echo 0;
            }
            else {
                //one is returned for connection error!
                echo 1;
            }
            break;

        case 'insert_nfc_to_all_commenters':
            # var1 = ReceiversLink
            # var2 = PostsLink
            $Link = uniqid('usr_nfc', true);
            $Message = "also commented on the post you commented.";
            $query = "INSERT INTO Users_Notifications SET
                Link = :Link,
                ReceiversLink = :ReceiversLink,
                Message = :Message,
                PostsLink = :PostsLink,
                UsersLink = :UsersLink
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':ReceiversLink', $var1);
            $database->bind(':Message', $Message);
            $database->bind(':PostsLink', $var2);
            $database->bind(':UsersLink', $_SESSION['UsersLink']);
            $database->execute();
            break;

        case 'insert_reply_nfc_to_commenter':
            #var1 = ReceiversLink
            #var2 = PostsLink
            $Link = uniqid('usr_nfc', true);
            $Message = "replied to your comment.";
            $query = "INSERT INTO Users_Notifications SET
                Link = :Link,
                ReceiversLink = :ReceiversLink,
                Message = :Message,
                PostsLink = :PostsLink,
                UsersLink = :UsersLink
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':ReceiversLink', $var1);
            $database->bind(':PostsLink', $var2);
            $database->bind(':Message', $Message);
            $database->bind(':UsersLink', $_SESSION['UsersLink']);
            $database->execute();
            break;

        case 'insert_reply_nfc_to_post_owner':
            #var1 = ReceiversLink
            #var2 = PostsLink
            $Link = uniqid('usr_nfc', true);
            $Message = " replied to a comment on your post!";
            $query = "INSERT INTO Users_Notifications SET
                Link = :Link,
                ReceiversLink = :ReceiversLink,
                Message = :Message,
                PostsLink = :PostsLink,
                UsersLink = :UsersLink
            ;";
            $database->query($query);
            $database->bind(':Link', $Link);
            $database->bind(':ReceiversLink', $var1);
            $database->bind(':PostsLink', $var2);
            $database->bind(':Message', $Message);
            $database->bind(':UsersLink', $_SESSION['UsersLink']);
            if ($database->execute()) {
                // zero is returned for no error
                echo 0;
            }
            else {
                // one is returned for connection error
                echo 1;
            }
            break;

        case 'rowCount_my_new_notifications':
            $query = "SELECT * FROM Users_Notifications
                WHERE ReceiversLink = :UsersLink
                AND Unread = 1
                AND Status != 0
            ;";
            $database->query($query);
            $database->bind(':UsersLink', $_SESSION['UsersLink']);
            return $r = $database->rowCount();
            break;

        case 'select_my_notifications':
            # $var1 = UsersLink
            $query = "SELECT * FROM Users_Notifications
                WHERE ReceiversLink = :UsersLink
                AND Status != 0
                $sorting LIMIT $limit;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();
            break;

        case 'mark_as_read':
            # $var1 = Link
            $query = "UPDATE Users_Notifications SET
                Unread = 0
                WHERE Link = :Link
            ;";
            $database->query($query);
            $database->bind(':Link', $var1);
            if ($database->execute()) {
                // zero is returned if there is no error
                echo 0;
            }
            else {
                // one is returned for connection error
                echo 1;
            }
            break;

        case 'delete_one':
            #var1 = Link
            $query = "UPDATE Users_Notifications SET
                Status = 0
                WHERE Link = :Link
            ;";
            $database->query($query);
            $database->bind(':Link', $var1);
            if ($database->execute()) {
                // zero is returned if there is no error
                echo 0;
            }
            else {
                //one is returned for connection error
                echo 1;
            }
            break;

        default:
            # code...
            break;
    }
}


?>
