<?php
  
require("connection.php");
session_start();
$user_id = $_COOKIE['user_id'];
$post_id = $_GET['id'];

$delete = $db -> prepare('DELETE from likes WHERE user_id = :user_id and post_id = :post_id');
$delete -> execute(array(
    
    'user_id'=> $user_id,
    'post_id'=> $post_id

));


$dislike = $db -> prepare('DELETE FROM notifications WHERE user_id = :user_id && post_id = :post_id');
$dislike -> execute(array(
    'user_id'=> $user_id,
    'post_id'=> $post_id
 ));
 echo '<script>window.history.back();</script>';
 exit();