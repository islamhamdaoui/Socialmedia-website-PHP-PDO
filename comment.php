<?php
session_start();
require("connection.php");
$user_id = $_SESSION['user_id'];
$comment = $_POST['comment'];
$post_id = $_POST['post_id'];
$add = $db ->prepare("INSERT INTO comments(post_id, user_id, comment)VALUES(:post_id, :user_id, :comment)");
$add -> execute(array(
    "user_id"=> $user_id, 
    "comment"=> $comment,
    "post_id"=> $post_id
));

header("location:postview.php?id=$post_id");