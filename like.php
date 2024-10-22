<?php
session_start();
require("connection.php");


$user_id = $_COOKIE['user_id'];
$post_id = $_GET['post_id'];
$owner_id = $_GET['owner_id'];
$username = $_COOKIE['username'];
//insert a like into database when u like any post
$add = $db->prepare("INSERT INTO likes(post_id, user_id, status,owner_id) VALUES(:post_id, :user_id, 'liked',:owner_id)");
$add->execute(array(
    "post_id" => $post_id, 
    "user_id" => $user_id,
    "owner_id" => $owner_id,

));


//send notification to the user that u liked his post
$message = "{$username} liked your post.";

$notification = $db->prepare("INSERT INTO notifications (post_id, user_id,owner_id, message ,is_read) VALUES (:post_id, :user_id,:owner_id, :message, 'No')");
$notification -> execute(array(
    "post_id"=> $post_id,
    "user_id"=> $user_id,
    "owner_id"=> $owner_id,
    "message"=> $message,

));


echo '<script>window.history.back();</script>';
exit();

