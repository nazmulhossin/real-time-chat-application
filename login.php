<?php
    session_start();

    if(isset($_SESSION["id"])) {
        header("location: http://localhost/real-time-chat-application/");
        exit;
    }

    require_once('inc/db_connection.php');
    $error_msg = $email = $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        $email = $DB_connection -> real_escape_string($_POST["email"]);
        $password = $DB_connection -> real_escape_string($_POST["password"]);

        $sql = "SELECT userid, name, email, password FROM user_info WHERE email='$email'";
        $result = $DB_connection -> query($sql);
        $row = $result -> fetch_assoc();

        if($result -> num_rows > 0 && password_verify($password, $row["password"])) {
            $_SESSION["id"] = $row["userid"];
            $_SESSION["name"] = $row["name"];
            header("location: http://localhost/real-time-chat-application/");
            exit;
        }
        else
            $error_msg = "The email and/or password you specified are not correct.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - UniChat</title>
    <?php require 'inc/config.php'; ?>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon 1.png">
    <link rel="stylesheet" type="text/css" href="assets/css/signup-login.css">
</head>
<body>
    <div id="form_container">
        <div id="form_wrapper">
            <span id="logo">UniChat</span>
            <span id="title">Log in</span>
            <form action="login" method="post">
                <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" required> <br>
                <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required> 
                <span class="error"><?php echo $error_msg ?></span><br>
                <input type="Submit" name="login" value="Log in"> <br>
            </form>
            <p>Don't have an account? <a href="signup">Sign Up</a> </p>
        </div>
    </div>
    
</body>
</html>