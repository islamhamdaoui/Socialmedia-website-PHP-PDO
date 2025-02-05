<?php
require("connection.php");

$user_id =  $_COOKIE['user_id'];
$username = $_COOKIE['username'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

$followed_id = $_GET['followed_id'];
$follower_id = $_COOKIE['user_id'];

//follow a user
$follow = $db -> prepare("INSERT INTO follow(follower_id, followed_id, status)VALUES(:follower_id, :followed_id, 'followed')");

$follow -> execute(array(
    "followed_id"=> $followed_id,
    "follower_id"=> $follower_id
    ) );


    //notification for the user that u followed
    $message = "{$username} followed you.";
    
    $notification = $db->prepare("INSERT INTO notifications (post_id, user_id, owner_id, message, is_read)
                                  VALUES (NULL, :user_id, :owner_id, :message, 'No')");
$notification -> execute(array(
    "user_id" => $user_id,
    "owner_id"=> $followed_id,
    "message"=> $message,

));
echo '<script>window.history.back();</script>';
    exit();
}