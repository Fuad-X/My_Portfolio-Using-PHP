<?php
    session_start();
    if(isset($_SESSION['username'])){
        require "../config.php";
        require "../models/SKILL.php";

        $title = addslashes($_POST['title']);
        $percentage = addslashes($_POST['percentage']);

        $sql = "INSERT INTO `$table_name` (`title`, `percentage`) VALUES ('$title', '$percentage')";

        if($conn->query($sql) === TRUE){
            $msg = "success=Skill+Created+Successfully";
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