<?php
  
require("connection.php");
session_start();
$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'];

$delete = $db -> prepare('DELETE from likes WHERE user_id = :user_id and post_id = :post_id');
$delete -> execute(array(
    
    'user_id'=> $user_id,
    'post_id'=> $post_id

));

header("location:home.php#post_$post_id");