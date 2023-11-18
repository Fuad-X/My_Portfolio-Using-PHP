<?php
    session_start();
    if(isset($_SESSION['username'])){
        require("../config.php");
        require "../models/CONTACT_LIST.php";

        $id = $_POST['delete'];

        $sql = "DELETE FROM `Contact_List` WHERE id='$id'";

        if($conn->query($sql) == TRUE){
            $msg = "success=Contact+Information+Deleted+Successfully";
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