<?php
session_start(); // Start session if not already started

require("auth.php"); // Include your authentication file
require("connection.php"); // Include your database connection file

if(isset($_POST["content"])) {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];
    
    $add = $db->prepare('INSERT INTO posts(user_id, content, name, image) VALUES (:user_id, :content, :name, :image)');
    

//THIS CODE ISN'T MINE I TOOK IT FROM GOOGLE TO UPLOAD IMAGES WITH POST
    for($i = 0; $i < count($_FILES['files']['name']); $i++) {
        $filename = $_FILES['files']['name'][$i];
        $tmp_name = $_FILES['files']['tmp_name'][$i];
        $target_file = './uploads/' . basename($filename);
        
        // File extension check
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $valid_extensions = array("png", "jpeg", "jpg","webp");
        
        if(in_array($file_extension, $valid_extensions)) {
            if(move_uploaded_file($tmp_name, $target_file)) {
                // Insert into database
                $add->execute(array(
                    'user_id' => $user_id,
                    'content' => $content,
                    'name' => $filename,
                    'image' => $target_file
                ));
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file extension.";
        }
    }
}

header('Location: profile.php');
exit();
?>
