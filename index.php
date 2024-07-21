<?php
session_start();  
//this will take u home if u already logged in
if(isset($_COOKIE['user'])){
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
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <?php
    //show a message if user email or password are wrong
     if (isset($_COOKIE['wrong']) && $_COOKIE['wrong'] == 'true') {
        echo '<div><span>Wrong email or password</span></div>';
       
    }?>
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
form div span{

    color: red;
        font-size: 13px;
}
input {
    width: 100%;
    max-width: 350px;
    margin-top: 20px;
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