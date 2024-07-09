<?php
require("connection.php");
session_start();

$followed_id = $_GET['followed_id'];
$follower_id = $_SESSION['user_id'];
$follow = $db -> prepare("INSERT INTO follow(follower_id, followed_id)VALUES(:follower_id, :followed_id)");

$follow -> execute(array(
    "followed_id"=> $followed_id,
    "follower_id"=> $follower_id
    ) );

    header("location: info.php?id=$followed_id&followed=yes");
    
    exit();    