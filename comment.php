<?php
session_start();
require("connection.php");
$user_id = $_COOKIE['user_id'];
$comment = $_POST['comment'];
$post_id = $_POST['post_id'];
$owner_id = $_POST['owner_id'];
$username = $_COOKIE['username'];


$add = $db ->prepare("INSERT INTO comments(post_id, user_id, comment)VALUES(:post_id, :user_id, :comment)");
$add -> execute(array(
    "user_id"=> $user_id, 
    "comment"=> $comment,
    "post_id"=> $post_id
));


$message = "{$username} commented on your post.";

$notification = $db->prepare("INSERT INTO notifications (post_id, user_id,owner_id, message ,is_read) VALUES (:post_id, :user_id,:owner_id, :message, 'No')");
$notification -> execute(array(
    "post_id"=> $post_id,
    "user_id"=> $user_id,
    "owner_id"=> $owner_id,
    "message"=> $message,

));



 $user = $db -> prepare("SELECT username,id FROM users");
 $user->execute();

 while($userData = $user ->fetch()) {
    if (str_contains($comment, $userData["username"])) {
        $message = "{$username} mentioned you in a comment.";
        $mentioned_id = $userData["id"];

        $notification = $db->prepare("INSERT INTO notifications (post_id, user_id,owner_id, message ,is_read) VALUES (:post_id, :user_id,:owner_id, :message, 'No')");
        $notification -> execute(array(
            "post_id"=> $post_id,
            "user_id"=> $user_id,
            "owner_id"=> $mentioned_id,
            "message"=> $message,
        
        ));
 }}
 echo  '<script>window.history.back()</script>';
 exit();