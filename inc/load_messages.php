<?php
    session_start();
    require_once('db_connection.php');

    $sender = $_SESSION["id"];
    $receiver = $_GET["uid"];
    $sql = "SELECT sender, receiver, message, date FROM messages WHERE (sender = $sender AND receiver = $receiver) OR (sender = $receiver AND receiver = $sender)";
    $result = $conn -> query($sql);

    while($row = $result -> fetch_assoc()) {
        if($row["sender"] == $sender)
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
?>