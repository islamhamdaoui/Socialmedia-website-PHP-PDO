<?php
require("connection.php");
session_start();
if (isset($_SESSION["user_id"]) && isset($_SESSION["username"])) {
    $id = $_SESSION["user_id"];
    $username = $_SESSION["username"];
    $respond = $db -> query("SELECT * FROM users");
    $column = $respond -> columnCount();
    // $data = $respond -> fetch();
    
    
       
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .user {
            background-color: #f1f1f1;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <a href="logout.php">Logout</a>
       
        <?php
   while ($data = $respond -> fetch()) {
    echo"<div class='user' onclick=\"window.location.href='info.php?id=$data[0]'\">";
    
      echo"<h1>". $data['username'] ."</h1>";
      echo"<span>". $data['email'] ."</span>";
   echo "</div>";
    
    }

?>
    </header>
</body>
</html>