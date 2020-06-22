<?php
require_once "conn.php";

//function to use data from the table Users
function table_Users($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'check_before_insert':
            // getting data from the form
            
            $query = "SELECT Id FROM Users
                WHERE Username = :Username
            ;";
            $database->query($query);
            $database->bind(':Username', $_REQUEST['Username']);
            return $rowCount = $database->rowCount();
            break;

        case 'insert':
            //getting data from the form
            $Username = trim($_REQUEST['Username']);
            $UsersLink = md5($Username);
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
                UsersLink = :UsersLink,               
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
            $database->bind(':UsersLink', $UsersLink);
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
                echo 'OK';
            }
            else {
                echo "There was a connection error! Please try again!";
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
                echo "<span class=\"green\">Your password has been updated successfully!</span>";
            }
            else {
                echo "<span class=\"error\">There was a connection error! Please try again!</span>";
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
                echo "<span class='green'>Your details have been updated successfully!</span>";
            }
            else {
                echo "<span class='error'>There was a connection error! Please try again!</span>";
            }
            break;

        case 'select_one_by_link':
            # $var1 = $UsersLink
            $query = "SELECT * FROM Users WHERE UsersLink = :UsersLink ;";
            $database->query($query);
            $database->bind(':UsersLink', $var1);
            return $r = $database->resultset();
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
            $link = uniqid('post_link', true);
            $query = "INSERT INTO Posts SET 
                link = :link,
                Title = :Title,
                Description = :Description,
                TagsId = :TagsId,
                UsersId = :UsersId
            ;";
            $database->query($query);
            $database->bind(':link', $link);
            $database->bind(':Title', trim($_GET['Title']));
            $database->bind(':Description', trim($_GET['Description']));
            $database->bind(':TagsId', $_GET['TagsId']);
            $database->bind(':UsersId', $_SESSION['UsersId']);
            if ($database->execute()) {
                return $link;
            }
            else {
                echo "Error!";
                die();
            }

            break;

        case 'select_all':
            $query = "SELECT * FROM Posts WHERE Posts.Status != 0 $sorting LIMIT $limit ;";
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
                WHERE CONCAT(
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
                WHERE CONCAT(
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

        case 'mark_as_sold_out':
            # $var1 = PostsId
            $query = "UPDATE Posts SET 
                Status = 3
                WHERE Id = :PostsId
            ;";
            $database->query($query);
            $database->bind(':PostsId', $var1);
            if ($database->execute()) {
                echo "Post updated successfully!";
            } 
            else {
                echo "There was a connection error! Please try again!";
            }
            break;    

        case 'select_one_user_posts':
            # $var1 = UsersId
            $query = "SELECT * FROM Posts WHERE UsersId = :UsersId $sorting LIMIT $limit ;";
            $database->query($query);
            $database->bind(':UsersId', $var1);
            return $r = $database->resultset();
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
                
        default:
            # code...
            break;
    }
}


//function to resize image.
function imageResize($imageResourceId,$width,$height) {
    $targetWidth = 240;
    $targetHeight = 240;

    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
    return $targetLayer;
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
                echo "OK";
            }
            else {
                echo "<span class='error'>There was a connection error! Please try again!</span>";
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

?>
