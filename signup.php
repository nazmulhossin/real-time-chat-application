<?php
    session_start();

    if(isset($_SESSION["id"])) {
        header("location: http://localhost/real-time-chat-application/");
        exit;
    }
    
    require 'inc/db_connection.php';  
    $name = $email = $emailError = $passwordError = $successful_msg = "" ;
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
        $name = $conn -> real_escape_string($_POST["name"]);
        $email =  $conn -> real_escape_string($_POST["email"]);
        $password = $conn -> real_escape_string($_POST["password"]);
        $confirmPassword = $conn -> real_escape_string($_POST["confirmPassword"]);

        $sql = "SELECT email FROM user_info WHERE email='".$email."'";
        $result = $conn -> query($sql);
        
        if(!preg_match("/^[A-Za-z0-9]+$/", $password))
            $passwordError = "Password must contain at least one alphabet or number.";
        elseif($password != $confirmPassword)
            $passwordError = "Passwords do not match";
        elseif($result -> num_rows > 0)
            $emailError = "An account with this email address already exists.";
        else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user_info (name, email, password) VALUES ('$name', '$email', '$password_hash')";
            if($conn -> query($sql) == TRUE) {
                $name = $email = "";
                $successful_msg = '<div id="successful_msg"><i class="fa-solid fa-circle-check"></i> <b>Congratulations!</b> Your account has been successfully created. Please <a href="login">login</a> to continue...</div>';
                header("refresh: 5; url= login");
            }
            else
                echo "Error: " . $conn -> error;            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - UniChat</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon 1.png">
    <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/signup-login.css">
</head>
<body>
    <?php echo $successful_msg; ?>

    <div id="form_container">
        <div id="form_wrapper">
            <span id="logo">UniChat</span>
            <span id="title">Sign Up</span>
            <form action="signup" method="post">
                <input type="text" name="name" placeholder="Name" value="<?php echo $name;?>" required> <br>
                <input type="email" name="email" placeholder="E-mail address" value="<?php echo $email;?>" required>
                <span class="error"><?php echo $emailError ?></span><br>
                <input type="password" name="password" placeholder="Password" required> <br>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <span class="error"><?php echo $passwordError ?></span><br>
                <input type="Submit" name="signup" value="Sign Up">
            </form>
            <p>Already have an account? <a href="login">Log in</a> </p>
        </div>
    </div>
    
</body>
</html>