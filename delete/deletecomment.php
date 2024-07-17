<?php

require("../connection.php");
session_start();
$user_id =  $_SESSION['user_id'];
$id = $_GET['id'];
$post_id = $_GET['post_id'];
$delete = $db ->prepare('DELETE FROM comments WHERE id = :id');
$delete -> execute(array('id'=> $id));

$dislike = $db -> prepare('DELETE FROM notifications WHERE user_id = :user_id && post_id = :post_id');
$dislike -> execute(array(
    'user_id'=> $user_id,
    'post_id'=> $post_id
 ));

 echo  '<script>window.history.back()</script>';
 exit();

