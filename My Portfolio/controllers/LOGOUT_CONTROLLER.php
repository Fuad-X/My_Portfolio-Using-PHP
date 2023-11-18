<?php
    session_start();
    if(isset($_SESSION['username'])){
        
        session_destroy();

        $msg = "success=Logged+Out+Successfully";

        $redirectUrl = "../index.php?$msg";
        header("Location: $redirectUrl");
    }
    else{
        header("Location: '../index.php'");
    }
?>