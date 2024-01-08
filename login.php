<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - UniChat</title>
    <?php require 'inc/config.php'; ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ($ROOT_DIRECTORY."/assets/img/favicon 1.png");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ($ROOT_DIRECTORY."/assets/css/signup-login.css");?>">
</head>
<body>
    <div id="form_container">
        <div id="form_wrapper">
            <span id="logo">UniChat</span>
            <span id="title">Log in</span>
            <form action="">
                <input type="text" name="username_or_email" placeholder="Username or E-mail"> <br>
                <input type="password" name="password" placeholder="Password"> <br>
                <input type="Submit" value="Log in"> <br>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign Up</a> </p>
        </div>
    </div>
    
</body>
</html>