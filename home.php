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
// index.php

require("connection.php");

// Fetch posts with user information including pdp
$show = $db->query('SELECT posts.id as post_id, posts.content, users.username, users.id, users.pdp, COUNT(comments.id) as comments_count
                   FROM posts 
                   INNER JOIN users ON posts.user_id = users.id 
                   LEFT JOIN comments ON posts.id = comments.post_id
                   GROUP BY 
                        posts.id, posts.content, users.username, users.id, users.pdp
                   ORDER BY posts.created_at DESC');

// Display posts and user information
echo '<div class="posts">';
while ($data = $show->fetch()) {
    echo '<div class="post">';
    echo "<div class='username' onclick=\"window.location.href='info.php?id={$data['id']}'\">";
    // Display the chosen animal image based on animal_choice
    if ($data['pdp'] === 'tiger') {
        echo '<img src="uploads/tiger.png" alt="Tiger Image">';
    } elseif ($data['pdp'] === 'monkey') {
        echo '<img src="uploads/monkey.png" alt="Monkey Image">';
    }
    echo "<h3 >" . htmlspecialchars($data['username']) . '</h3>';
    echo "</div>";

    
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    echo "<div><div class='comment' onclick=\"window.location.href='postview.php?id={$data['post_id']}'\">{$data['comments_count']} Comment</div> </div>";
    
    
    
    echo '</div>';
}
echo '</div>';
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

        .username {
            display: flex;
            align-items: center;
        }
        .username img {
            width: 25px;
            margin-right: 7px;
            height: 25px;

        }
        .username h3 {
            margin: 0;
        }
            </style>
</body>
</html>