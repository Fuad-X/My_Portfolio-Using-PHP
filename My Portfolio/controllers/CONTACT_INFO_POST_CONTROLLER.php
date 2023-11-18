<?php
    session_start();
    require "../config.php";
    require "../models/CONTACT_LIST.php";

    $name = addslashes($_POST['name']);
    $email = addslashes($_POST['email']);
    $subject= addslashes($_POST['subject']);
    $description = addslashes($_POST['description']);


    $sql = "INSERT INTO `$table_name` (name, email, subject, description) VALUES ('$name', '$email', '$subject', '$description')";

    if($conn->query($sql) === TRUE){
        $msg = "success=Your+Information+Submitted+Successfully";
    } else {
        $msg = "failed=Please+Submit+the+Form+Correctly";
    }
    
    $redirectUrl = "../index.php?$msg";
    
    header("Location: $redirectUrl");
?>