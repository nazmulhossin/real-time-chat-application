<?php
    session_start();
    require_once('db_connection.php');

    $sender = $_SESSION["id"];
    $receiver = $_GET["uid"];

    $sql = "SELECT image FROM user_info WHERE userid = $sender";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $sender_profile_pic = $row["image"];

    $sql = "SELECT name, image FROM user_info WHERE userid = $receiver";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $receiver_name = $row["name"];
    $receiver_profile_pic = $row["image"];

    echo '<div id="chat_info">
            <img src="'.$profile_images_folder.$receiver_profile_pic.'" alt=""> <span>'.$receiver_name.'</span>
        </div>';

    $sql = "SELECT sender, receiver, message, date FROM messages WHERE (sender = $sender AND receiver = $receiver) OR (sender = $receiver AND receiver = $sender)";
    $result = $conn -> query($sql);

    echo '<div id="messages">';
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

    echo '</div>';
    echo '<div id="reply_section">
            <textarea id="message_input" placeholder="Write your message..." onkeydown="handleKeyPress(event)"></textarea>
            <button class="submit chatButton" id="chatButton" onclick="sendMessage()"><i class="fa fa-paper-plane"></i></button>
        </div>';
?>