<?php
session_start();
require("connection.php");
$user_id = $_SESSION['user_id'];
$comment = $_POST['comment'];
$post_id = $_POST['post_id'];
$owner_id = $_POST['owner_id'];
$username = $_SESSION['username'];


$add = $db ->prepare("INSERT INTO comments(post_id, user_id, comment)VALUES(:post_id, :user_id, :comment)");
$add -> execute(array(
    "user_id"=> $user_id, 
    "comment"=> $comment,
    "post_id"=> $post_id
));


$message = "{$username} commented on your post";

$notification = $db->prepare("INSERT INTO notifications (post_id, user_id,owner_id, message ,is_read) VALUES (:post_id, :user_id,:owner_id, :message, 'No')");
$notification -> execute(array(
    "post_id"=> $post_id,
    "user_id"=> $user_id,
    "owner_id"=> $owner_id,
    "message"=> $message,

));

//  header("location:postview.php?id=$post_id");
