<?php
    require_once("config.php");
    
    // create connection with database
    $DB_connection = new mysqli($servername, $db_username, $db_password, $db_name);

    // check connection
    if($DB_connection -> connect_error)
        die("Connection failed: " . $DB_connection -> connect_error);

    // for encode and decode char
    //$DB_connection -> set_charset("utf8");
?>