<?php 

require("connection.php");

$id = $_GET['id'];

$show = $db ->prepare("SELECT posts.id as post_id, posts.content, users.username ,users.id
 FROM posts 
 INNER JOIN users ON posts.user_id = users.id where posts.id = :id");

 $show -> execute(array("id"=> $id));

 $data = $show -> fetch();

 echo $data["username"];
 echo $data["content"];

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

