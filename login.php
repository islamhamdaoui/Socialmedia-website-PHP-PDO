<!-- <?php
require("connection.php");
session_start(); 



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION['user'] = true;
        setcookie('user', true, time() + (86400 * 30), "/");

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
?> -->
<?php
require("connection.php");
session_start(); // Start session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email']; 
        $password = $_POST['password'];
        $_SESSION['user'] = true;
        setcookie('user', true, time() + (86400 * 30), "/");
        
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE email = :email"); 

        
        $stmt->execute(array(
            "email" => $email, 
        ));

       
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            setcookie('user_id', $user['id'], time() + (86400 * 30), "/");
            setcookie('username', $user['username'], time() + (86400 * 30), "/");
            header('location:home.php');
           
            exit; 
        } else {
           
            setcookie('wrong', 'true', time() + 3, '/');
            header("location:logout.php");
           
        }
    }
}
?>
