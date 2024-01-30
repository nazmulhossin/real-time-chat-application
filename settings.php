<?php
    session_start();
    require_once 'inc/db_connection.php';
    $userid = $_SESSION["id"];
    $sql = "SELECT name, password, image FROM user_info WHERE userid = $userid";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $userName = $row["name"];
    $userImage = $row["image"];
    $oldPassword = $newPassword = $confirmNewPassword = "";
    $oldPasswordError = $newPasswordError = $confirmNewPasswordError = $successful_msg = "" ;
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["saveChanges"])) {
        $name = $conn -> real_escape_string($_POST["name"]);
        $oldPassword = $conn -> real_escape_string($_POST["oldPassword"]);
        $newPassword = $conn -> real_escape_string($_POST["newPassword"]);
        $confirmNewPassword = $conn -> real_escape_string($_POST["confirmNewPassword"]);
        
        if(!empty($_POST["newPassword"]) || !empty($_POST["confirmNewPassword"])) {
            if(password_verify($oldPassword, $row["password"])) {
                if(!preg_match("/^[A-Za-z0-9]+$/", $newPassword))
                    $newPasswordError = "Password must contain at least one alphabet or number.";
                elseif($newPassword != $confirmNewPassword)
                    $confirmNewPasswordError = "Passwords do not match";
                else {
                    $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
                    $sql = "UPDATE user_info SET name = '$name', password = '$password_hash' WHERE userid = $userid";

                    if($conn -> query($sql) == TRUE) {
                        $successful_msg = '<div id="successful_msg">Your settings have been successfully saved.</div>';
                        $oldPassword = $newPassword = $confirmNewPassword = "";
                    }
                        
                    else
                        echo "Error: " . $conn -> error;            
                }
            }
            else
                $oldPasswordError = "The password you specified is not correct.";
        }

        else if($userName != $name) {
            $sql = "UPDATE user_info SET name = '$name' WHERE userid = $userid";
            if($conn -> query($sql) == TRUE) {
                $successful_msg = '<div id="successful_msg">Your settings have been successfully saved.</div>';
                $userName = $name;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - UniChat</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon 1.png">
    <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/settings.css">
</head>
<body>
    <?php echo $successful_msg; ?>

    <div id="container">
        <div id="form_container">
            <span id="logo">UniChat</span>
            <span id="title">Settings</span>
            <div id="form_wrapper">
                <div>
                    <img src="<?php echo $profile_images_folder.$userImage; ?>" alt="" id="profile_pic">
                    <label for="input_image" id="change_image">Change Image</label> <input type="file" id="input_image" onchange="uploadProfileImage(this.files)">
                </div>
                
                <form action="settings" method="post">
                    <input type="text" name="name" placeholder="Name" value="<?php echo $userName;?>" required> <br>
                    <input type="password" name="oldPassword" id="oldPassword" value="<?php echo $oldPassword;?>" placeholder="Old password">
                    <span class="error"><?php echo $oldPasswordError ?></span><br>
                    <input type="password" name="newPassword" id="newPassword" value="<?php echo $newPassword;?>" placeholder="New password" onkeyup="addRequired()">
                    <span class="error"><?php echo $newPasswordError ?></span><br>
                    <input type="password" name="confirmNewPassword" id="confirmNewPassword" value="<?php echo $confirmNewPassword;?>" placeholder="Confirm new password" onkeyup="addRequired()">
                    <span class="error"><?php echo $confirmNewPasswordError ?></span><br>
                    <input type="Submit" name="saveChanges" value="Save changes"> <br>
                </form>
            </div>

            <div id="go_back">
                <a href="http://localhost/real-time-chat-application/">Go to Homepage</a>
            </div>
        </div>
    </div>

    <script>
        function addRequired() {
            var oldPasswordEle = document.getElementById("oldPassword");
            var newPasswordEle = document.getElementById("newPassword");
            var confirmNewPasswordEle = document.getElementById("confirmNewPassword");
            var newPassword = newPasswordEle.value;
            var confirmNewPassword = confirmNewPasswordEle.value;
            
            if(newPassword.length > 0 || confirmNewPassword.length > 0) {
                oldPasswordEle.required = true;
                newPasswordEle.required = true;
                confirmNewPasswordEle.required = true;
            }

            else {
                oldPasswordEle.required = false;
                newPasswordEle.required = false;
                confirmNewPasswordEle.required = false;
            }
        }

        function uploadProfileImage(files) {
            var change_image = document.getElementById("change_image");
            var input_image = document.getElementById("input_image")
            input_image.disabled = true;
            change_image.innerHTML = "Uploading Image...";
            var formData = new FormData();
            formData.append('file', files[0]);

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    imageName = xhr.responseText;
                    input_image.disabled = false;
                    change_image.innerHTML = "Change Image";
                    document.getElementById("profile_pic").src = "assets/img/users/" + xhr.responseText;
                }
            }

            xhr.open("POST", "inc/upload_profile_image.php", true);
            xhr.send(formData);
        }
    </script>
</body>
</html>