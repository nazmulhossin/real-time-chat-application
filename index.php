<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniChat</title>
    <?php require 'inc/config.php'; ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ($ROOT_DIRECTORY."/assets/img/favicon 1.png");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ($ROOT_DIRECTORY."/assets/css/all.min.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ($ROOT_DIRECTORY."/assets/css/fontawesome.min.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ($ROOT_DIRECTORY."/assets/css/style.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ($ROOT_DIRECTORY."/assets/css/responsive.css");?>">
</head>
<body>
    <div id="container">
        <div id="wrapper">
            <div id="left_panel">
                <div id="left_panel_header">
                    <span id="logo">UniChat</span>
                    <div id="user_profile">
                        <img src="assets/img/user3.jpg" alt=""> <span>Md. Nazmul Hossain</span> <button>Logout</button>
                    </div>
                </div>
                
                <div id="search">
                    <label for=""><i class="fa fa-search" aria-hidden="true"></i></label> <input type="text" placeholder="Search a user..." />					
                </div>

                <div id="chats">
                    <div class="chat_profile">
                        <img src="assets/img/user5.jpg" alt="">
                        <div class="chat_profile_info">
                            <span>Sujan Roy</span>
                            <p>Hello!</p>
                        </div>
                    </div>

                    <div class="chat_profile">
                        <img src="assets/img/user4.jpg" alt="">
                        <div class="chat_profile_info">
                            <span>Unknown Girl</span>
                            <p>Hi!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="right_panel">
                
                <div id="chat_info">
                    <img src="assets/img/user5.jpg" alt=""> <span>Sujan Roy</span>
                </div>

                <div class="messages" id="conversation">
                <!--<h1>Choose a chat to start the conversation</h1>-->

                    <div class="message owner">
                        <div class="message-info">
                            <img src="assets/img/user3.jpg" alt="">
                            <span>Just now</span>
                        </div>

                        <div class="message-content">
                            <p>Hello!</p>
                            <img src="" alt="">
                        </div>
                    </div>

                    <div class="message">
                        <div class="message-info">
                            <img src="assets/img/user5.jpg" alt="">
                            <span>Just now</span>
                        </div>

                        <div class="message-content">
                            <p>Hi!</p>
                            <img src="" alt="">
                        </div>
                    </div>

                    <div class="message">
                        <div class="message-info">
                            <img src="assets/img/user5.jpg" alt="">
                            <span>Just now</span>
                        </div>

                        <div class="message-content">
                            <p>This is Sujan Roy</p>
                            <img src="assets/img/user5.jpg" alt="">
                        </div>
                    </div>
                </div>

                <div id="reply_section">
                    <input type="text" class="chatMessage" id="message_input" placeholder="Write your message..." />
					<button class="submit chatButton" id="chatButton"><i class="fa fa-paper-plane"></i></button>
				</div>
            </div>
        </div>
    </div>
    
</body>
</html>