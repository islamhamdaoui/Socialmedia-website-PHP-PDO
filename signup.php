<?php
require("connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email']; // Optional field

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO users(username, password, email) VALUES (:username, :password, :email)");

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // No hashing

        // If using email field, bind it too
        if (!empty($email)) {
            $stmt->bindParam(':email', $email);
        } else {
            $email = null; // Ensure it's null if not provided
            $stmt->bindParam(':email', $email, PDO::PARAM_NULL);
        }

        // Execute the query
        try {
            $stmt->execute();
            echo "Registration successful.";
        } catch (PDOException $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }
}
?>
