<?php
session_start();  
if(isset($_SESSION['user'])){
  header('location:home.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
 require('header.php');

?>

<!-- Login Form -->
 <div class="login">


<form method="post" action="login.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="login" value="Login">
    <a href="signupform.php">Create new account</a>
</form>
</div>

<style>


*{
    box-sizing: border-box;
}

.login {
    padding: 100px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    max-width: 350px;
    width: 100%;
}

input {
    width: 100%;
    max-width: 350px;
    margin-bottom: 20px;
    height: 45px;
    border-radius: 8px;
    border: none;
    padding: 5px 10px;
    background-color: #fff;
    box-shadow: 1px 4px 5px rgba(0, 0, 0, 0.1);
}

input[type=submit] {
    background-color: #0866ff;
    color: #fff;
    font-weight: bold;
    width: 100%;
    margin-bottom: 5px;
    cursor: pointer;

} 
input[type=submit]:hover {
    opacity: 0.7;
}
</style>
</body>
</html>