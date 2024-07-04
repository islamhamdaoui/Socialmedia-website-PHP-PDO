<?php
  
  require("connection.php");

  session_start();
  $id = $_SESSION['user_id'];

  $select = $db -> prepare("SELECT * FROM users WHERE id= :id");
  $select -> execute(array('id'=>$id ));
  
  $data = $select ->fetch();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="edit.php" method="post">
        <input type="text" placeholder="Username" name="username" value="<?php echo $data['username']  ?>"> <br><br>
        <input type="text" placeholder="Email" name="email" value="<?php echo $data['email']  ?>" > <br><br>
        <input type="text" placeholder="Password" name="password" value="<?php echo $data['password']  ?>" > <br><br>
        <input type="hidden" name="id" value="<?php echo $data['id']  ?>">
        <input type="submit" value="Save profile">

    </form>
</body>
</html>