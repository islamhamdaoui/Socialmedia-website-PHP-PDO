<?php
require("connection.php");


$followed_id = $_GET['followed_id'];
$follower_id = $_COOKIE['user_id'];
//unfollow user
$unfollow = $db -> prepare("DELETE FROM follow WHERE follower_id = :follower_id AND followed_id = :followed_id");

$unfollow -> execute(array(
    "followed_id"=> $followed_id,
    "follower_id"=> $follower_id
    ) );
    
    //delete notification that he received when u followed him
    $dislike = $db -> prepare('DELETE FROM notifications WHERE user_id = :user_id and post_id is NULL');
    $dislike -> execute(array('user_id'=> $follower_id ));

    //hadi to go back to last page
    echo '<script>window.history.back();</script>';
    exit();