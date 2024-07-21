<?php
require("connection.php");
if(isset($_GET['post_id'])&& isset($_GET['user_id'])) {

    $post_id =$_GET['post_id'];
    $user_id =$_GET['user_id'];
} elseif (isset($_GET['post_id'])) {
    $post_id =$_GET['post_id'];
    $user_id =null;
} elseif (isset($_GET['user_id'])) {
    $post_id =null;
    $user_id =$_GET['user_id'];
}
$id =$_GET['id'];

//this one updates its_read in database so u can see if u read the notification or not
$update = $db -> prepare('UPDATE notifications SET is_read = "YES" WHERE id = :id');
$update -> execute(array('id'=> $id));

if($post_id !== null) {
    header('location:postview.php?id='.$post_id);

} elseif($user_id !== null) {
    header('location:info.php?id='.$user_id);
}

