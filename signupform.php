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
        <!-- Registration Form -->
<form method="post" action="signup.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="email" name="email" placeholder="Email (optional)"><br>
    <input type="submit" name="register" value="Register">
</form>

</body>
</html>