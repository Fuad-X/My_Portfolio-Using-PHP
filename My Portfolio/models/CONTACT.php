<?php
    $table_name = 'Contacts';
    $find_sql = "SHOW TABLES LIKE '$table_name'";
    $searched_table = $conn->query($find_sql);

    if($searched_table->num_rows == 0){
        $insert_sql = "CREATE TABLE `$table_name` (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            icon VARCHAR(128) NOT NULL,
            link VARCHAR(128) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $conn->query($insert_sql);
    }
?>