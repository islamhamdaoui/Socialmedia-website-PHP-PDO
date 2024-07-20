<?php
require("../connection.php");
$post_id = $_GET['post_id'];

$deleteNotifications = $db ->prepare("DELETE FROM notifications WHERE post_id = :post_id");
$deleteNotifications -> execute(array("post_id"=> $post_id));


$deleteComments = $db ->prepare("DELETE FROM comments WHERE post_id = :post_id");
$deleteComments -> execute(array("post_id"=> $post_id));

$deleteLikes = $db ->prepare("DELETE FROM likes WHERE post_id = :post_id");
$deleteLikes -> execute(array("post_id"=> $post_id));


$deletePost = $db ->prepare("DELETE FROM posts WHERE id = :post_id");
$deletePost -> execute(array("post_id"=> $post_id));

echo '<script>window.history.back();</script>';
    exit();
