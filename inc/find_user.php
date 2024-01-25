<?php
    session_start();
    require_once('db_connection.php');

    $pattern = $_GET["q"];

    if($pattern == "")
        exit;

    $sql = 'SELECT userid, name FROM user_info WHERE NOT userid = "'.$_SESSION["id"].'"';
    $result = $conn -> query($sql);

    $user_list = "<ul>";
    while($row = $result -> fetch_assoc()) {
        if(stristr($row["name"], $pattern) !== FALSE)
            $user_list .= '<li data-userid="'.$row["userid"].'" onclick="loadData(\'inc/add_to_chat_list.php?q=\'+this.dataset.userid, addToChatList)"><img src="assets/img/user5.jpg" alt=""> <span class="user-name" >'.$row["name"].'</span></li>';
    }

    if($user_list === "<ul>")
        $user_list .= '<li class="no-user-name"><span>no suggestion</span></li>';

    $user_list .= '</ul>';

    echo $user_list;
?>