<?php
    session_start();
    if(isset($_SESSION['username'])){
        $file = $_FILES['image']['tmp_name'];

        if(move_uploaded_file($file, "../images/cover.png")){
            $msg = "success=Cover+Changed+Successfully";
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