<?php
 require("connection.php");

 require("auth.php");

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

<?php
 require('header.php');

?>
    <b>Your username: </b>
    <span><?php echo $data['username'] ?></span> <br><br>
    <b>Your email: </b>
    <span><?php echo $data['email'] ?></span> <br><br>
    <button onclick="location.href='editform.php'">Edit profile</button>

    <div class="post">
        <form action="post.php">
            <input type="text" placeholder="Add new post...">
            <input type="submit" value="Add">
        </form>
    </div>


    <style>

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }
        
        .post {
            max-width: 350px;
            width: 100%;
            display: flex;
            background-color: #fff;
            flex-direction: column;
        }

        .post form input {
            
        }
    </style>
</body>
</html>