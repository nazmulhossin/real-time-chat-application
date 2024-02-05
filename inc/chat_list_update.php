<?php
    session_start();
    require_once('db_connection.php');
    $active_userid = $_GET["uid"];

    $sql = 'SELECT user_info.userid, user_info.name, user_info.image, max(messages.chatid) AS chatid, SUM(CASE WHEN messages.seen = 0 AND messages.receiver = '.$_SESSION["id"].' THEN 1 ELSE 0 END) AS unseen_msg_count FROM user_info JOIN messages ON user_info.userid = messages.sender OR user_info.userid = messages.receiver WHERE (messages.sender = '.$_SESSION["id"].' OR messages.receiver = '.$_SESSION["id"].') AND NOT user_info.userid = '.$_SESSION["id"].' GROUP BY user_info.name ORDER BY chatid DESC';
    $result = $conn -> query($sql);
    while($row = $result -> fetch_assoc()) {
        if($row["userid"] == $active_userid)
            echo '<li id="'.$row["userid"].'" class="active" onclick="activeUser(this); loadData(\'inc/display_messages.php?uid=\'+this.id, displayMessages)"><img src="'.$profile_images_folder.$row["image"].'" alt=""><div><span>'.$row["name"].'</span></div>';
        else
            echo '<li id="'.$row["userid"].'" onclick="activeUser(this); loadData(\'inc/display_messages.php?uid=\'+this.id, displayMessages)"><img src="'.$profile_images_folder.$row["image"].'" alt=""><div><span>'.$row["name"].'</span></div>';
        
        if($row["unseen_msg_count"] > 0)
            echo '<div class="msg-count"><span>'.$row["unseen_msg_count"].'</span></div>';

        echo '</li>';
    }
?>