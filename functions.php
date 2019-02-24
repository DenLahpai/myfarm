<?php
require_once "conn.php";

//function to use data from the table Users
function table_Users($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'check_before_insert':
            // getting data from the form
            $Title = $_REQUEST['Title'];
            $Name = trim($_REQUEST['Name']);
            $Mobile = trim($_REQUEST['Mobile']);
            $query = "SELECT Id FROM Users
                WHERE Title = :Title
                AND Name = :Name
                AND Mobile = :Mobile
            ;";
            $database->query($query);
            $database->bind(':Title', $Title);
            $database->bind(':Name', $Name);
            $database->bind(':Mobile', $Mobile);
            return $rowCount = $database->rowCount();
            break;

        case 'insert':
            //getting data from the form
            $Title = $_REQUEST['Title'];
            $Name = trim($_REQUEST['Name']);
            $Mobile = trim($_REQUEST['Mobile']);
            $Password = trim($_REQUEST['Mobile']);
            $DOB = $_REQUEST['DOB'];
            $Address = trim($_REQUEST['Address']);
            $Town = trim($_REQUEST['Town']);
            $State = trim($_REQUEST['State']);
            $Country = trim($_REQUEST['Country']);
            $query = "INSERT INTO Users (
                Title,
                Name,
                Mobile,
                Password,
                DOB,
                Address,
                Town,
                State,
                Country,
                Status
                ) VALUES (
                :Title,
                :Name,
                :Mobile,
                :Password,
                :DOB,
                :Address,
                :Town,
                :State,
                :Country,
                :Status
                )
            ;";
            $database->query($query);
            $database->bind(':Title', $Title);
            $database->bind(':Name', $Name);
            $database->bind(':Mobile', $Mobile);
            $database->bind(':Password', $Password);
            $database->bind(':DOB', $DOB);
            $database->bind(':Address', $Address);
            $database->bind(':Town', $Town);
            $database->bind(':State', $State);
            $database->bind(':Country', $Country);
            $database->bind(':Status', 1);
            if ($database->execute()) {
                header("location: index.php");
            }
            break;

        default:
            // code...
            break;
    }
}

?>
