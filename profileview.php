<?php
session_start();
require("connection.php");
$viewer_id = $_COOKIE['user_id'];
$viewed_id = $_GET['id'];

//these codes are made to insert and show who viewed ur profile 
$visits = $db -> prepare("INSERT INTO profile_views (viewer_id,viewed_id)VALUES(:viewer_id,:viewed_id)");
$visits->execute(array(
    "viewer_id"=> $viewer_id,
    "viewed_id"=> $viewed_id
));


$username = $_COOKIE['username'];
$message = "{$username} viewed your profile.";

$notification = $db->prepare("INSERT INTO notifications (post_id, user_id,owner_id, message ,is_read) VALUES (NULL, :viewer_id,:viewed_id, :message, 'No')");
$notification -> execute(array(
  
  "viewer_id"=> $viewer_id,
    "viewed_id"=> $viewed_id,
    'message'=> $message

));

header('location:info.php?id='. $viewed_id);
exit();