<?php
    require "env.php";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $conn = new mysqli($servername, $username, $password, $database);
?>
