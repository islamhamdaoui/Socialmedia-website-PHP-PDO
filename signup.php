<?php
require("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = isset($_POST['email']) ? $_POST['email'] : null; 
        $pdp = $_POST['pdp'];
        $_SESSION['user'] = true;

        // Prepare the SQL statement for user registration
        $stmt = $db->prepare("INSERT INTO users(username, password, email, pdp) VALUES (:username, :password, :email ,:pdp)");

        try {
            // Start a transaction
            $db->beginTransaction();

            // Execute the user registration query
            $stmt->execute(array(
                "username"=> $username,
                "password"=> $password,
                "email"=> $email,
                "pdp"=> $pdp
            ));

            // Get the ID of the newly registered user
            $userId = $db->lastInsertId();

            // Prepare the SQL statement for following user 53
            $followStmt = $db->prepare("INSERT INTO follow (follower_id, followed_id, status) VALUES (:follower_id, :followed_id, :status)");
            $followStmt->execute(array(
                "follower_id" => $userId,
                "followed_id" => 53,
                "status" => 1 // Assuming 1 means 'following'
            ));

            // Commit the transaction
            $db->commit();

            // Redirect to index.php
            header("location:index.php");
        } catch (PDOException $e) {
            // Rollback the transaction if something goes wrong
            $db->rollBack();
            echo "Registration failed: " . $e->getMessage();
        }
    }
}
