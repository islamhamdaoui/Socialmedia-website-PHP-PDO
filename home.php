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


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <button type="submit" name="all">Show All</button>
    <button type="submit" name="followed">Show Followed</button>
</form>



<div class="posts"  id='all'>
    
<?php

// index.php

if (isset($_POST['all'])) {
    displayAll();
    
} elseif (isset($_POST['followed'])) {
    displayFollowed();
    
} else {
    displayAll();
}
    function displayAll(){
require("connection.php");

// Fetch posts with user information including pdp
$show = $db->query('SELECT posts.id as post_id, posts.content, DATE(posts.created_at) as post_date, users.username, users.id, users.pdp, COUNT(comments.id) as comments_count
                   FROM posts 
                   INNER JOIN users ON posts.user_id = users.id 
                   LEFT JOIN comments ON posts.id = comments.post_id
                   GROUP BY 
                        posts.id, posts.content, users.username, users.id, users.pdp
                   ORDER BY posts.created_at DESC');

// Display posts and user information

while ($data = $show->fetch()) {
    echo '<div class="post">';
    echo "<div class='username' onclick=\"";
    if ($data['username'] === $_SESSION['username']) {
        echo "window.location.href = 'profile.php';";
    } else {
        echo "window.location.href = 'info.php?id={$data['id']}';";
    }
    echo "\">";
    
    if ($data['pdp'] === 'default') {
        echo '<img src="uploads/default.png" alt="default Image">';
    } elseif ($data['pdp'] === 'sara') {
        echo "<img src='uploads/sara.png' alt='sara Image'>";
    } elseif ($data['pdp'] === 'dalia') {
        echo "<img  src='uploads/dalia.png' alt='dalia Image'>";
    }  elseif ($data['pdp'] === 'islam') {
        echo"<img src='uploads/islam.png' alt='islam Image'>";
    }
    elseif ($data['pdp'] === 'mohamed') {
        echo"<img class='image' src='uploads/mohamed.png' alt='mohamed Image'>";
    } else {
        echo '<img src="uploads/default.png" alt="default Image">';
    }
    echo "<div class='userdiv' >";
    echo "<h3 >" . htmlspecialchars($data['username']) . '</h3>';
    echo "<span>" .$data['post_date'] . "</span>";
    echo '</div>';

    echo "</div>";

    
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    echo "<div><div class='comment' onclick=\"window.location.href='postview.php?id={$data['post_id']}'\">{$data['comments_count']} Comment</div> </div>";
    
    
    
    echo '</div>';
}
echo '</div>';
} 
?>

    </div>

    <div class="followed" id='followed'>
<?php
 function displayFollowed(){
    
    require('connection.php');
    $follower_id = $_SESSION['user_id'];

    $followed = $db->prepare("
    SELECT posts.id as post_id, posts.content, DATE(posts.created_at) as post_date, users.username, users.id, users.pdp, COUNT(comments.id) as comments_count
    FROM posts
    INNER JOIN users ON posts.user_id = users.id
    INNER JOIN follow ON users.id = follow.followed_id
    LEFT JOIN comments ON posts.id = comments.post_id
    WHERE follow.follower_id = :follower_id
    GROUP BY posts.id, posts.content, users.username, users.id, users.pdp
    ORDER BY posts.created_at DESC");


 
 $followed ->execute(array("follower_id"=> $follower_id));


 while ($data = $followed->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="post">';
    echo "<div class='username' onclick=\"";
    if ($data['username'] === $_SESSION['username']) {
        echo "window.location.href = 'profile.php';";
    } else {
        echo "window.location.href = 'info.php?id={$data['id']}';";
    }
    echo "\">";
    
    if ($data['pdp'] === 'default') {
        echo '<img src="uploads/default.png" alt="default Image">';
    } elseif ($data['pdp'] === 'sara') {
        echo "<img src='uploads/sara.png' alt='sara Image'>";
    } elseif ($data['pdp'] === 'dalia') {
        echo "<img  src='uploads/dalia.png' alt='dalia Image'>";
    }  elseif ($data['pdp'] === 'islam') {
        echo"<img src='uploads/islam.png' alt='islam Image'>";
    }
    elseif ($data['pdp'] === 'mohamed') {
        echo"<img class='image' src='uploads/mohamed.png' alt='mohamed Image'>";
    } else {
        echo '<img src="uploads/default.png" alt="default Image">';
    }
    echo "<div class='userdiv' >";
    echo "<h3 >" . htmlspecialchars($data['username']) . '</h3>';
    echo "<span>" .$data['post_date'] . "</span>";
    echo '</div>';

    echo "</div>";

    
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    echo "<div><div class='comment' onclick=\"window.location.href='postview.php?id={$data['post_id']}'\">{$data['comments_count']} Comment</div> </div>";
    
    
    
    echo '</div>';
}
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
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 15px;
           
        }
        .post {
            width: 100%;
            max-width: 470px;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
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
            width: 38px;
            margin-right: 7px;
            height: 38px;
           
        }
    
        .username h3 {
            margin: 0;
        }

        .userdiv span {
            font-size: 12px;
            color: rgb(101, 103, 107);
        }

        .followed {
            display: none;
        }
            </style>



<script>
    function all(){
        let all =document.getElementById("all")
        let followed =document.getElementById("followed")

        all.style.display = 'block'
        followed.style.display = 'none'
    }
    function followed(){
        let all =document.getElementById("all")
        let followed =document.getElementById("followed")

        all.style.display = 'none'
        followed.style.display = 'block'
    }
</script>
</body>
</html>