<?php
    session_start();
    if(isset($_SESSION['username'])){
        $content = $_POST['bio'];

        $filePath = "../files/bio.txt";

        if (file_put_contents($filePath, $content)) {
            $msg = "success=Bio+Changed+Successfully";
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