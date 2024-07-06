<?php
require("connection.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = isset($_POST['email']) ? $_POST['email'] : null; 
        $pdp = $_POST['pdp'];
        $_SESSION['user'] = true;

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO users(username, password, email, pdp) VALUES (:username, :password, :email ,:pdp)");

        // Execute the query with the values
        try {
            $stmt->execute(array(
                "username"=> $username,
                "password"=> $password,
                "email"=> $email,
                "pdp"=> $pdp
            ));
            header("location:index.php");
        } catch (PDOException $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }
}

