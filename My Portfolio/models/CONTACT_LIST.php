<?php
    $table_name = 'Contact_List';
    $find_sql = "SHOW TABLES LIKE '$table_name'";
    $searched_table = $conn->query($find_sql);

    if($searched_table->num_rows == 0){
        $insert_sql = "CREATE TABLE `$table_name` (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            subject VARCHAR(55) NOT NULL,
            description VARCHAR(255) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        $conn->query($insert_sql);
    }
?>