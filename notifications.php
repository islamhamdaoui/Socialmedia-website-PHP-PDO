<?php
require("connection.php");
session_start();

$user_id = $_SESSION['user_id'];

$notifications = $db -> prepare('SELECT * FROM notifications WHERE owner_id = :user_id and user_id != :user_id  ');
$notifications -> execute(array('user_id'=> $user_id));
    while($data = $notifications -> fetch()) {

        echo "<div>" . $data['message'] . "</div><br>";
    }
?>
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