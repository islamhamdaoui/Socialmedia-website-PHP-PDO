<?php
session_start();
require("connection.php");
$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'];



$add = $db ->prepare("INSERT INTO likes(post_id, user_id, status)VALUES(:post_id, :user_id, 'liked')");
$add -> execute(array(
    "user_id"=> $user_id, 
    "post_id"=> $post_id
));

header("location:home.php#post_$post_id");