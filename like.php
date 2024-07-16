<?php
session_start();
require("connection.php");


$user_id = $_SESSION['user_id'];
$post_id = $_GET['post_id'];
$owner_id = $_GET['owner_id'];
$username = $_SESSION['username'];

$add = $db->prepare("INSERT INTO likes(post_id, user_id, status,owner_id) VALUES(:post_id, :user_id, 'liked',:owner_id)");
$add->execute(array(
    "post_id" => $post_id, 
    "user_id" => $user_id,
    "owner_id" => $owner_id,

));



$message = "{$username} liked your post.";

$notification = $db->prepare("INSERT INTO notifications (post_id, user_id,owner_id, message ,is_read) VALUES (:post_id, :user_id,:owner_id, :message, 'No')");
$notification -> execute(array(
    "post_id"=> $post_id,
    "user_id"=> $user_id,
    "owner_id"=> $owner_id,
    "message"=> $message,

));

header("Location: home.php#post_$post_id");
exit();

