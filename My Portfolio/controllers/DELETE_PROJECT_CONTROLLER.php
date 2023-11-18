<?php
    session_start();
    if(isset($_SESSION['username'])){
        require("../config.php");
        require "../models/PROJECT.php";

        $id = $_POST['delete'];

        $sql = "SELECT * FROM `$table_name` WHERE id='$id'";

        $search_data = $conn->query($sql);

        $row = $search_data->fetch_assoc();

        unlink("../images/".$row['path']);

        $sql = "DELETE FROM `$table_name` WHERE id='$id'";

        if($conn->query($sql) == TRUE){
            $msg = "success=Project+Deleted+Successfully";
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