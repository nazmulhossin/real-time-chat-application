<?php
    session_start();
    require_once('db_connection.php');
    $userid = $_SESSION["id"];

    if(isset($_FILES['file']) && !empty($_FILES['file']['name']) && $_FILES['file']['error'] == 0) {
        // $fileType = $_FILES['file']['type'];
        // $fileSize = $_FILES['file']['size'];

        $sql = "SELECT image FROM user_info WHERE userid = $userid";
        $result = $conn -> query($sql);
        $row = $result -> fetch_assoc();

        if($row["image"] != "blank-profile-picture.jpg")
            unlink('../assets/img/users/'.$row["image"]);
        
        $newFileName = md5(time()).'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if(move_uploaded_file($_FILES['file']['tmp_name'], '../assets/img/users/'.$newFileName)) {
            $sql = "UPDATE user_info SET image = '$newFileName' WHERE userid = $userid";
            if($conn -> query($sql) === TRUE)
                echo $newFileName;
        }

        // // Validate file type and size (optional)
        // if (!in_array($fileType, ['image/jpeg', 'image/png', 'application/pdf'])) {
        //   die('Invalid file type!');
        // }
      
        // if ($fileSize > 1000000) { // 1 MB limit
        //   die('File size too large!');
        // }
    }
?>