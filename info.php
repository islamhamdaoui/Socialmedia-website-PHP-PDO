<?php
 require("connection.php");

    $id = $_GET['id'];
 $select = $db -> prepare("SELECT * FROM users WHERE id=:id");
    $select -> execute(array(
        'id' => $id
    ));

    $data = $select->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <b>Username: </b>
    <span><?php echo $data['username'];  ?></span> <br><br>
    <b>Email: </b>
    <span><?php echo $data['email'];  ?></span>
</body>
</html>