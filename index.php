<?php
    session_start();
    if(!isset($_SESSION["id"])) {
        header("Location: login");
        exit;
    }

    require_once('inc/db_connection.php');
    $sql = 'SELECT name, image FROM user_info WHERE userid = '.$_SESSION["id"];
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $userName = $row["name"];
    $userImage = $row["image"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniChat</title>
    <?php require 'inc/config.php'; ?>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon 1.png">
    <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div id="container">
        <div id="wrapper">
            <div id="left_panel">
                <div id="left_panel_header">
                    <span id="logo">UniChat</span>
                    <div id="user_profile">
                        <img src="<?php echo $profile_images_folder.$userImage; ?>" alt=""> <span><?php echo $userName; ?></span> <a href="settings"><i class="fa-solid fa-gear"></i></a>
                    </div>
                </div>
                
                <div id="find_user">
                    <div id="search">
                        <label for=""><i class="fa-solid fa-magnifying-glass"></i></label> <input type="text" placeholder="Find a user..." onkeyup="loadData('inc/find_user.php?q='+this.value, findUser)"/>					
                    </div>

                    <div id="search_result">
                    </div>
                </div>

                <div id="chat_list">
                    <ul id="chat_profiles">
                        <?php
                            $sql = 'SELECT user_info.userid, user_info.name, user_info.image, max(messages.chatid) AS chatid, SUM(CASE WHEN messages.seen = 0 AND messages.receiver = '.$_SESSION["id"].' THEN 1 ELSE 0 END) AS unseen_msg_count FROM user_info JOIN messages ON user_info.userid = messages.sender OR user_info.userid = messages.receiver WHERE (messages.sender = '.$_SESSION["id"].' OR messages.receiver = '.$_SESSION["id"].') AND NOT user_info.userid = '.$_SESSION["id"].' GROUP BY user_info.name ORDER BY chatid DESC';
                            $result = $conn -> query($sql);
                            while($row = $result -> fetch_assoc()) {
                                if($row["unseen_msg_count"] > 0)
                                    echo '<li id="'.$row["userid"].'" onclick="activeUser(this); loadData(\'inc/display_messages.php?uid=\'+this.id, displayMessages)"><img src="'.$profile_images_folder.$row["image"].'" alt=""><div><span>'.$row["name"].'</span></div> <div class="msg-count"><span>'.$row["unseen_msg_count"].'</span></div></li>';
                                else
                                    echo '<li id="'.$row["userid"].'" onclick="activeUser(this); loadData(\'inc/display_messages.php?uid=\'+this.id, displayMessages)"><img src="'.$profile_images_folder.$row["image"].'" alt=""><div><span>'.$row["name"].'</span></div></li>';
                            }
                        ?>
                    </ul>

                    <span class="unlist_chat_profile unlist-user" style="display:none;"></span>
                </div>

                <div id="logout">
                    <a href="logout"><span>Logout</span> <i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </div>

            <div id="right_panel">
                <div id="no_chat">
                    <h1>Choose a chat to start the conversation</h1>
                </div>

                <div id="chatting_section" style="display: none;">
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>