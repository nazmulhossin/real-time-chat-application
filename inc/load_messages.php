<?php
    session_start();
    require_once('db_connection.php');

    $sender = $_SESSION["id"];
    $receiver = $_GET["uid"];

    $sql = "SELECT image FROM user_info WHERE userid = $sender";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $sender_profile_pic = $row["image"];

    $sql = "SELECT image FROM user_info WHERE userid = $receiver";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $receiver_profile_pic = $row["image"];

    $sql = "UPDATE messages SET seen = 1 WHERE sender = $receiver AND receiver = $sender";
    $result = $conn -> query($sql);

    $sql = "SELECT sender, receiver, message, date FROM messages WHERE (sender = $sender AND receiver = $receiver) OR (sender = $receiver AND receiver = $sender)";
    $result = $conn -> query($sql);

    while($row = $result -> fetch_assoc()) {
        if($row["sender"] == $sender)
            echo '<div class="message-container owner">
                <div class="user-img">
                    <img src="'.$profile_images_folder.$sender_profile_pic.'" alt="">
                </div>

                <div class="message-wrapper">
                    <div class="message-content">
                        <p>'.$row["message"].'</p>
                        <img src="" alt="">
                    </div>

                    <div class="message-date">
                        <span>'.date("M j, Y, g:i A", strtotime($row["date"])).'</span>
                    </div>
                </div>
            </div>';

        else
            echo '<div class="message-container">
                <div class="user-img">
                    <img src="'.$profile_images_folder.$receiver_profile_pic.'" alt="">
                </div>

                <div class="message-wrapper">
                    <div class="message-content">
                        <p>'.$row["message"].'</p>
                        <img src="" alt="">
                    </div>

                    <div class="message-date">
                        <span>'.date("M j, Y, g:i A", strtotime($row["date"])).'</span>
                    </div>
                </div>
            </div>';
    }
?>