<?php
    session_start();
    if(isset($_SESSION['username'])){
        require("../config.php");
        require "../models/SKILL.php";

        $id = $_POST['delete'];

        $sql = "DELETE FROM `$table_name` WHERE id='$id'";

        if($conn->query($sql) == TRUE){
            $msg = "success=Skill+Deleted+Successfully";
        } else {
            $msg = "failed=Something+Went+Wrong+Please+Try+Again";
        }
        
        $redirectUrl = "../index.php?$msg";

        header("Location: $redirectUrl");
    }
    else{
        header("Location: '../index.php'");
    }
?>