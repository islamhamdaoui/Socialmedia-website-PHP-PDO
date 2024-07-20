<?php
session_start();
require("../connection.php");
$user_id = $_COOKIE['user_id'];

$clear = $db -> prepare('DELETE FROM notifications WHERE owner_id = :user_id');
$clear -> execute(['user_id'=> $user_id]);

echo  '<script>window.history.back()</script>';
exit();