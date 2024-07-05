<?php
require("auth.php");
require("connection.php");

if(isset($_POST["content"])) {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];
    $add = $db -> prepare('INSERT INTO posts(user_id, content)VALUES(:user_id, :content)');


    $add -> execute(array(
        'user_id'=> $user_id,
        'content'=> $content
));


header('location: profile.php');
die();
}

