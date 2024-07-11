<?php
require("connection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

$followed_id = $_GET['followed_id'];
$follower_id = $_SESSION['user_id'];
$follow = $db -> prepare("INSERT INTO follow(follower_id, followed_id, status)VALUES(:follower_id, :followed_id, 'followed')");

$follow -> execute(array(
    "followed_id"=> $followed_id,
    "follower_id"=> $follower_id
    ) );

    header("location: info.php?id=$followed_id");
    
    
    exit();    
}