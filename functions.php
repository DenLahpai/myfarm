<?php
require_once "conn.php";

function login () {
    header('location: register.html');
}

//function to use data from the table Users
function table_Users($job, $var1, $var2) {
    $database = new Database();

    switch ($job) {
        case 'check_before_insert':
            // getting data from the form
            $Mobile = trim($_REQUEST['Mobile']);
            $query = "SELECT Id FROM Users
                WHERE Mobile = :Mobile
            ;";
            $database->query($query);
            $database->bind(':Mobile', $Mobile);
            return $rowCount = $database->rowCount();
            break;

        case 'insert':
            //getting data from the form
            $Mobile = trim($_REQUEST['Mobile']);
            $Password = trim($_REQUEST['Password']);
            $Title = $_REQUEST['Title'];
            $First_name = trim($_REQUEST['First_name']);
            $Last_name = trim($_REQUEST['Last_name']);
            $DOB = $_REQUEST['DOB'];
            $Address = trim($_REQUEST['Address']);
            $Town = trim($_REQUEST['Town']);
            $State = trim($_REQUEST['State']);
            $Country = trim($_REQUEST['Country']);
            $query = "INSERT INTO Users SET
                Mobile = :Mobile,
                Password = :Password,
                Title = :Title,
                First_name = :First_name,
                Last_name = :Last_name,
                DOB = :DOB,
                Address = :Address,
                Town = :Town,
                State = :State,
                Country = :Country,
                Status = :Status
            ;";
            $database->query($query);
            $database->bind(':Mobile', $Mobile);
            $database->bind(':Password', $Password);
            $database->bind(':Title', $Title);
            $database->bind(':First_name', $First_name);
            $database->bind(':Last_name', $Last_name);
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
