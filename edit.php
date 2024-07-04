<?php

require("connection.php");
$id= $_POST['id'];
$username= $_POST['username'];
$email= $_POST['email'];
$password= $_POST['password'];

$repond = $db ->prepare('UPDATE users SET username =:username, email=:email, password =:password WHERE id = :id');
$repond -> execute(array(
    'id'=> $id,
    'username'=> $username,
    'email'=> $email,
    'password'=> $password
));

header('location:profile.php');
die;