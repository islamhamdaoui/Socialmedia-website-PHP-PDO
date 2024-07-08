<?php

require("../connection.php");

$id = $_GET['id'];
$post_id = $_GET['post_id'];
$delete = $db ->prepare('DELETE FROM comments WHERE id = :id');
$delete -> execute(array('id'=> $id));

header("location:../postview.php?id=$post_id");
exit();

