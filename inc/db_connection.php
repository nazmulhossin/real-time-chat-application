<?php
    require_once("config.php");
    
    // create connection with database
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // check connection
    if($conn -> connect_error)
        die("Connection failed: " . $conn -> connect_error);
?>