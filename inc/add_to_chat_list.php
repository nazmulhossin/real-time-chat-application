<?php
    session_start();
    require_once('db_connection.php');

    $userid = $_GET["userid"];
    $sql = 'SELECT name FROM user_info WHERE userid = "'.$userid.'"';
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();

    echo '<li userid="'.$userid.'"><img src="assets/img/user5.jpg" alt=""><div><span>'.$row["name"].'</span><p>Hello!</p></div></li>';
?>