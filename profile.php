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

    <div class="addpost" >
        <form action="post.php" method="post">
            <input type="text" name="content" placeholder="Add new post..." required>
            <input type="submit" value="Add">
        </form>
    </div>

    <div class="posts">
    <?php
 $userid = $_SESSION["user_id"];
 $show = $db->prepare('SELECT posts.content, users.username ,DATE(posts.created_at) AS  date
 FROM posts 
 INNER JOIN users ON posts.user_id = users.id 
 WHERE users.id=:id  ORDER BY posts.created_at DESC');



$show->execute(array('id' => $userid));
              

while ($data = $show->fetch(PDO::FETCH_ASSOC)){
    echo '<div class="post">';
    echo '<h3>' . htmlspecialchars($data['username']) . '</h3>';
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    echo '<p>' . htmlspecialchars($data['date']) . '</p>'; 
    echo '</div>';

 

}
 

?>
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
        
        .addpost {
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

        .addpost form input {
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

        .addpost form input[type=submit] {
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

.posts {
    margin-top: 50px;
}
.post {
    width: 400px;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #e0f2f1;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
    </style>
</body>
</html>