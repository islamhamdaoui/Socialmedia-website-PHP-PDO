<?php
require("connection.php");
require("auth.php");

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
<?php
 require('header.php');

?>
<!--    
       
        <?php
   while ($data = $respond -> fetch()) {
    echo"<div class='user' onclick=\"window.location.href='info.php?id=$data[0]'\">";
    
      echo"<h1>". $data['username'] ."</h1>";
      echo"<span>". $data['email'] ."</span>";
   echo "</div>";
    
    }

?> -->


 
<div class="posts">
    <?php


 $show = $db->query('SELECT posts.id as post_id, posts.content, users.username ,users.id, COUNT(comments.id) as comments_count
 FROM posts 
 INNER JOIN users ON posts.user_id = users.id 
  LEFT JOIN comments ON posts.id = comments.post_id
  GROUP BY 
        posts.id, posts.content, users.username, users.id
ORDER BY posts.created_at DESC');




              
while ($data = $show->fetch()) {
    echo '<div class="post">';
    echo "<h3 onclick=\"window.location.href='info.php?id={$data['id']}'\">" . htmlspecialchars($data['username']) . '</h3>';
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    echo "<div><div class='comment' onclick=\"window.location.href='postview.php?id={$data['post_id']}'\">{$data['comments_count']} Comment</div> </div>";
    echo '</div>';

    $_SESSION['post_id']= $data['post_id'];
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

        .comment {
            background-color: #f6f6f6;
            padding: 5px 10px;
            cursor: pointer;
        }
            </style>
</body>
</html>