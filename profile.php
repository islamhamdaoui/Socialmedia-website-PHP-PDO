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

    <div class="post" >
        <form action="post.php" method="post">
            <input type="text" name="content" placeholder="Add new post..." required>
            <input type="submit" value="Add">
        </form>
    </div>
    <div class="posts">

    </div>

    <style>
     *{
        box-sizing: border-box;
     }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }
        
        .post {
            max-width: 350px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            flex-direction: column;
            margin-top: 50px;
            padding: 10px 10px;
            border-radius: 8px;
        }

        .post form input {
            width: 100%;
    max-width: 350px;
    margin-bottom: 20px;
    height: 45px;
    border-radius: 8px;
    border: none;
    padding: 5px 10px;
    background-color: #fff;
    box-shadow: 1px 4px 5px rgba(0, 0, 0, 0.1);
        }

        .post form input[type=submit] {
    background-color: #0866ff;
    color: #fff;
    font-weight: bold;
    width: 100%;
    margin-bottom: 5px;
    cursor: pointer;

} 
input[type=submit]:hover {
    opacity: 0.7;
}
    </style>
</body>
</html>