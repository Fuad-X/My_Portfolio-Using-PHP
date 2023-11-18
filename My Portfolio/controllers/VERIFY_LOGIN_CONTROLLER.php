<?php
    session_start();
    require("../config.php");
    require "../models/DEFAULT_ADMIN.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `$table_name` WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION['username'] = $username;
            $msg = "success=Logged+In+Successfully";
        }else{
            $msg = "failed=Failed+To+Login.+Invalid+Username+Or+Password";
        }
    }
    else{
        $msg = "failed=Failed+To+Login.+Invalid+Username+Or+Password";
    }
    
    $redirectUrl = "../index.php?$msg";

    header("Location: $redirectUrl");
?>