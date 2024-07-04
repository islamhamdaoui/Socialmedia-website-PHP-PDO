<?php
 require("connection.php");
 session_start();

 $id = $_SESSION["user_id"];
 $select = $db ->prepare("SELECT * FROM users WHERE id= :id");
 $select -> execute(array("id"=> $id));


    $data = $select -> fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <b>Your username: </b>
    <span><?php echo $data['username'] ?></span> <br><br>
    <b>Your email: </b>
    <span><?php echo $data['email'] ?></span> <br><br>
    <button onclick="location.href='editform.php'">Edit profile</button>
</body>
</html>