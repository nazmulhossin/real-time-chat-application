<?php
    /* Connect to MySQL database 
    $servername = "localhost";
    $username = "";
    $password = "";
    $dbname = "";

    // create connection with database
    $DB_connection = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if($DB_connection -> connect_error)
        die("Connection failed: " . $DB_connection -> connect_error);

    // for encode and decode bangla char
    $DB_connection -> set_charset("utf8");
    // mysql_query("SET SESSION collation_connection ='utf8_general_ci'");
    */

    /* Control directory */
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $ROOT_DIRECTORY = "http://localhost/real-time-chat-application";
    $CURRENT_DIRECTORY = $protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/';
?>