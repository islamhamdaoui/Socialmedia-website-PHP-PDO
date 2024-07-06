<?php

require("connection.php");
$id= $_POST['id'];
$username= $_POST['username'];
$email= $_POST['email'];
$password= $_POST['password'];
$pdp = $_POST['pdp'];

$repond = $db ->prepare('UPDATE users SET username =:username, email=:email, pdp =:pdp, password =:password WHERE id = :id');
$repond -> execute(array(
    'id'=> $id,
    'username'=> $username,
    'email'=> $email,
    'password'=> $password,
    'pdp'=> $pdp
));

header('location:profile.php');
die;