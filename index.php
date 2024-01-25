<?php
    session_start();
    if(!isset($_SESSION["id"])) {
        header("Location: login");
        exit;
    }

    require_once('inc/db_connection.php');
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
                        <img src="assets/img/user3.jpg" alt=""> <span><?php echo $_SESSION["name"]; ?></span> <a href="logout"><button>Logout</button></a>
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
                            $sql = 'SELECT DISTINCT user_info.userid, user_info.name FROM user_info JOIN messages ON user_info.userid = messages.sender OR user_info.userid = messages.receiver WHERE (messages.sender = '.$_SESSION["id"].' OR messages.receiver = '.$_SESSION["id"].') AND NOT user_info.userid = '.$_SESSION["id"].' ORDER BY messages.date DESC';
                            $result = $conn -> query($sql);
                            while($row = $result -> fetch_assoc()) {
                                echo '<li data-userid="'.$row["userid"].'" onclick="activeUser(this); loadData(\'inc/display_messages.php?uid=\'+this.dataset.userid, displayMessages)"><img src="assets/img/user5.jpg" alt=""><div><span>'.$row["name"].'</span><p>Hi!</p></div></li>';
                            }
                        ?>
                    </ul>
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