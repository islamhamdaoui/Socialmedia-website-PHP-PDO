<?php
require("connection.php");
session_start();

$followed_id = $_GET['followed_id'];
$follower_id = $_SESSION['user_id'];

$unfollow = $db -> prepare("DELETE FROM follow WHERE follower_id = :follower_id AND followed_id = :followed_id");

$unfollow -> execute(array(
    "followed_id"=> $followed_id,
    "follower_id"=> $follower_id
    ) );

     header("location: info.php?id=$followed_id");
    exit();    