
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialDZ</title>
</head>
<body>
    <?php
    require('header.php');

  
  require("connection.php");

 
  $id = $_COOKIE['user_id'];

  $select = $db -> prepare("SELECT * FROM users WHERE id= :id");
  $select -> execute(array('id'=>$id ));
  
  $data = $select ->fetch();


?>

    <div class="editProfile">

    <form action="edit.php" method="post">
        <input type="text" placeholder="Username" name="username" value="<?php echo $data['username']  ?>" onkeydown="preventSpace(event)"> <br><br>
        <input type="text" placeholder="Email" name="email" value="<?php echo $data['email']  ?>" > <br><br>
        <input type="text" placeholder="Password" name="password" value="<?php echo $data['password']  ?>" > <br><br>
        <input type="hidden" name="id" value="<?php echo $data['id']  ?>">
            
    <label for="animal_choice">profile picture: </label>
        <select id="animal_choice" name="pdp" required>
            <option value="default">Default</option>
            <option value="sara">Sara</option>
            <option value="dalia">Dalia</option>
            <option value="islam">Islam</option>
            <option value="mohamed">Mohamed</option>
        </select><br><br>
        <input type="submit" value="Save profile">

    </form></div>

    <script>
             function preventSpace(event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        }
    </script>



<style>

    *{
        box-sizing: border-box;
    }
  .editProfile{
    display: flex;
    padding:100px 10px;
    justify-content: center;

  }


  form {
    max-width: 350px;
    width: 100%;
}
form div span{

    color: red;
        font-size: 13px;
}
input {
    width: 100%;
    max-width: 350px;
    margin-top: 0px;
    height: 40px;
    border-radius: 8px;
    border: none;
    padding: 5px 10px;
    background-color: #fff;
    box-shadow: 1px 4px 5px rgba(0, 0, 0, 0.1);
}

input[type=submit] {
    background-color: #0866ff;
    color: #fff;
    
    font-weight: bold;
   
   
    cursor: pointer;

} 
</style>
</body>
</html>