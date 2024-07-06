<?php
require("connection.php");
function insertImage($user_id, $image_name, $image_path, $db) {
    try {
        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO images (user_id, image_name, image_path) VALUES (:user_id, :image_name, :image_path)");
        
        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':image_name', $image_name);
        $stmt->bindParam(':image_path', $image_path);
        
        // Execute the statement
        $stmt->execute();
        
        echo "Image uploaded and inserted successfully.";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    $user_id = $_POST['user_id']; // User ID from form
    $image_name = $_POST['image_name']; // Image name from form
    
    // File upload path
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image_file"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["image_file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["image_file"]["name"])). " has been uploaded.";
            
            // Insert image details into database
            $image_path = $target_file;
            insertImage($user_id, $image_name, $image_path, $db);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
$db = null;
?>