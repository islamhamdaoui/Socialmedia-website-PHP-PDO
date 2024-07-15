<?php
require("connection.php");

$post_id =$_GET['post_id'];
$id =$_GET['id'];

$update = $db -> prepare('UPDATE notifications SET is_read = "YES" WHERE id = :id');
$update -> execute(array('id'=> $id));

header('location:postview.php?id='.$post_id);
