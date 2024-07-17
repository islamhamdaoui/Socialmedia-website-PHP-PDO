<?php
  
  require("connection.php");

  session_start();
  $id = $_COOKIE['user_id'];

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
        <input type="text" placeholder="Username" name="username" value="<?php echo $data['username']  ?>" onkeydown="preventSpace(event)"> <br><br>
        <input type="text" placeholder="Email" name="email" value="<?php echo $data['email']  ?>" > <br><br>
        <input type="text" placeholder="Password" name="password" value="<?php echo $data['password']  ?>" > <br><br>
        <input type="hidden" name="id" value="<?php echo $data['id']  ?>">
            
    <label for="animal_choice">Choose an animal:</label><br>
        <select id="animal_choice" name="pdp" required>
            <option value="default">Default</option>
            <option value="sara">Sara</option>
            <option value="dalia">Dalia</option>
            <option value="islam">Islam</option>
            <option value="mohamed">Mohamed</option>
        </select><br><br>
        <input type="submit" value="Save profile">

    </form>

    <script>
             function preventSpace(event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        }
    </script>
</body>
</html>