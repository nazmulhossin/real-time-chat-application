<?php
    session_start();
    require_once('db_connection.php');

    $sender = $_SESSION["id"];
    $receiver = $_GET["uid"];
    $sql = "SELECT name FROM user_info WHERE userid = $receiver";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();

    echo '<div id="chat_info">
            <img src="assets/img/user5.jpg" alt=""> <span>'.$row["name"].'</span>
        </div>';

    $sql = "SELECT sender, receiver, message, date FROM messages WHERE (sender = $sender AND receiver = $receiver) OR (sender = $receiver AND receiver = $sender)";
    $result = $conn -> query($sql);

    echo '<div id="messages">';
    while($row = $result -> fetch_assoc()) {
        if($row["sender"] == $_SESSION["id"])
            echo '<div class="message-container owner">
                <div class="user-img">
                    <img src="assets/img/user3.jpg" alt="">
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
                    <img src="assets/img/user3.jpg" alt="">
                </div>

                <div class="message-wrapper">
                    <div class="message-content">
                        <p>'.$row["message"].'</p>
                        <img src="" alt="">
                    </div>

                    <div class="message-date">
                        <span>'.date("M j, Y, H:i A", strtotime($row["date"])).'</span>
                    </div>
                </div>
            </div>';
    }

    echo '</div>';
    echo '<div id="reply_section">
            <textarea id="message_input" placeholder="Write your message..."></textarea>
            <button class="submit chatButton" id="chatButton" onclick="loadData(\'inc/send_message.php?uid=\'+document.querySelector(\'.active\').dataset.userid+\'&msg=\'+document.getElementById(\'message_input\').value, sendMessage)"><i class="fa fa-paper-plane"></i></button>
        </div>';
?>