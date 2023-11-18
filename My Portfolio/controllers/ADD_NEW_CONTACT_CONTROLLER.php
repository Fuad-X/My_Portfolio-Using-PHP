<?php
    session_start();
    if(isset($_SESSION['username'])){
        require "../config.php";
        require "../models/CONTACT.php";

        $icon = addslashes($_POST['icon']);
        $link = addslashes($_POST['link']);

        $sql = "INSERT INTO `$table_name` (`icon`, `link`) VALUES ('$icon', '$link')";

        if($conn->query($sql) === TRUE){
            $msg = "success=Contact+Created+Successfully";
        } else {
            $msg = "failed=Please+Submit+The+Form+Correctly";
        }

        $redirectUrl = "../index.php?$msg";
        
        header("Location: $redirectUrl");
    }
    else{
        header("Location: '../index.php'");
    }
?>