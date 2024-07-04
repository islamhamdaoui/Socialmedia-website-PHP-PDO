<?php
require("connection.php");
session_start(); // Start session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION['user'] = true;

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = :username");

        // Execute the query with the username
        $stmt->execute(array(
            "username"=> $username,
        ));

        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('location:home.php');
            // Redirect to another page or do something else after successful login
        } else {
            echo"<div>Login failed. Invalid username or password</div>";
            header("location:logout.php");
        }
    }
}
?>

