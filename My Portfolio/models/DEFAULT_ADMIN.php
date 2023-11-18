<?php
    require "../env.php";

    $table_name = 'Users';
    $find_sql = "SHOW TABLES LIKE '$table_name'";
    $searched_table = $conn->query($find_sql);

    if($searched_table->num_rows == 0){
        $insert_sql = "CREATE TABLE `$table_name` (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(54) NOT NULL,
            password VARCHAR(256) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $conn->query($insert_sql);

        $hashedPassword = password_hash($login_pass, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO $table_name (username, password) VALUES (?, ?)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $login_user, $hashedPassword); 
    
        if ($stmt->execute()) {
            echo "Admin account created successfully.";
        } else {
            echo "Error creating admin account: " . $stmt->error;
        }
        
        $stmt->close();
    }
?>