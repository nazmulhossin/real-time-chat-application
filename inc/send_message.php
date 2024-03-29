<?php
    session_start();
    require_once('db_connection.php');

    $data = json_decode(file_get_contents('php://input'), true);
    $sender = $_SESSION["id"];
    $receiver = $data["uid"];
    $message = htmlspecialchars($data["msg"], ENT_QUOTES);

    $sql = "SELECT image FROM user_info WHERE userid = $sender";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $sender_profile_pic = $row["image"];

    $sql = "SELECT image FROM user_info WHERE userid = $receiver";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $receiver_profile_pic = $row["image"];

    if(!isset($message) || empty($message))
        exit;

    $sql = "INSERT INTO messages (sender, receiver, message) VALUES ($sender, $receiver, '$message')";

    if($conn -> query($sql) === FALSE) {
        echo "Couldn't send.";
        exit;
    }

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