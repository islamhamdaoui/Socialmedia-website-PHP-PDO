<?php
require("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = isset($_POST['email']) ? $_POST['email'] : null; // Optional field
        $_SESSION['user'] = true;

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO users(username, password, email) VALUES (:username, :password, :email)");

        // Execute the query with the values
        try {
            $stmt->execute(array(
                "username"=> $username,
                "password"=> $password,
                "email"=> $email
            ));
            header("location:home.php");
        } catch (PDOException $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }
}
?>
