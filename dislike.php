<?php
  
require("connection.php");
session_start();
$user_id = $_COOKIE['user_id'];
$post_id = $_GET['id'];

//remove the like from post
$delete = $db -> prepare('DELETE from likes WHERE user_id = :user_id and post_id = :post_id');
$delete -> execute(array(
    
    'user_id'=> $user_id,
    'post_id'=> $post_id

));

//remove the like notification so that the user won't see that u liked a post after u removed it
$dislike = $db -> prepare('DELETE FROM notifications WHERE user_id = :user_id && post_id = :post_id');
$dislike -> execute(array(
    'user_id'=> $user_id,
    'post_id'=> $post_id
 ));
 echo '<script>window.history.back();</script>';
 exit();