<?php
    session_start();
    if(isset($_SESSION['username'])){
        require "../config.php";
        require "../models/PROJECT.php";

        $sql = "SELECT AUTO_INCREMENT
            FROM information_schema.TABLES
            WHERE TABLE_SCHEMA = '$database'
            AND TABLE_NAME = '$table_name'";

        $count_table = $conn->query($sql);

        $last_id = 0;
        if ($count_table->num_rows > 0) {
            $row = $count_table->fetch_assoc();
            $last_id = $row['AUTO_INCREMENT'];
        }

        $link = addslashes($_POST['link']);
        $path = addslashes("project_".$last_id.".".pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        $file = $_FILES['image']['tmp_name'];

        move_uploaded_file($file, "../images/".$path);

        $sql = "INSERT INTO `$table_name` (`link`, `path`) VALUES ('$link', '$path')";

        if($conn->query($sql) === TRUE){
            $msg = "success=Project+Created+Successfully";
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