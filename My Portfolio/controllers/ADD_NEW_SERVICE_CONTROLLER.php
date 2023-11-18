<?php
    session_start();
    if(isset($_SESSION['username'])){
        require "../config.php";
        require "../models/SERVICE.php";

        $icon = addslashes($_POST['icon']);
        $title = addslashes($_POST['title']);
        $description = addslashes($_POST['description']);

        $sql = "INSERT INTO `$table_name` (`icon`, `title`, `description`) VALUES ('$icon', '$title', '$description')";

        if($conn->query($sql) === TRUE){
            $msg = "success=Service+Created+Successfully";
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