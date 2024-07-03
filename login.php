<?php
require("connection.php");
session_start(); // Start session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = :username");

        // Bind parameter
        $stmt->bindParam(':username', $username);

        // Execute the query
        $stmt->execute();

        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "Login successful. Welcome, " . $user['username'];
            // Redirect to another page or do something else after successful login
        } else {
            echo "Login failed. Invalid username or password.";
        }
    }
}
?>
