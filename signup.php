<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - UniChat</title>
    <?php require 'inc/config.php'; ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ($ROOT_DIRECTORY."/assets/img/favicon 1.png");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ($ROOT_DIRECTORY."/assets/css/signup-login.css");?>">
</head>
<body>
    <div id="form_container">
        <div id="form_wrapper">
            <span id="logo">UniChat</span>
            <span id="title">Sign Up</span>
            <form action="">
                <input type="text" name="name" placeholder="Name"> <br>
                <input type="text" name="username" placeholder="Username"> <br>
                <input type="password" name="password" placeholder="Password"> <br>
                <input type="password" name="confirmPassword" placeholder="Confirm Password"> <br>
                <input type="email" name="email" placeholder="E-mail address"> <br>
                <input type="Submit" value="Sign Up"> <br>
            </form>
            <p>Already have an account? <a href="login.php">Log in</a> </p>
        </div>
    </div>
    
</body>
</html>