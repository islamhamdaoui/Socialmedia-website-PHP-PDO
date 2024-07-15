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

<div class="suggestions">
<div>
    <span>Suggested for you</span>
</div>

<?php

 require('suggestions.php');



?>
</div>

<!--    
       
        <?php
   while ($data = $respond -> fetch()) {
    echo"<div class='user' onclick=\"window.location.href='info.php?id=$data[0]'\">";
    
      echo"<h1>". $data['username'] ."</h1>";
      echo"<span>". $data['email'] ."</span>";
   echo "</div>";
    
    }

?> -->


<div class="homeContainer">

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

$user = $_SESSION["user_id"];



$show = $db->prepare('SELECT 
posts.id as post_id, 
posts.content, 
DATE(posts.created_at) as post_date, 
users.username,
users.verified, 
users.pdp as pdp,
users.id as user_id, 
COUNT(DISTINCT comments.id) as comments_count, 
COUNT(DISTINCT likes.id) as likes_count,
SUM(CASE WHEN likes.user_id = ? THEN 1 ELSE 0 END) as liked_by_user
FROM 
posts 
INNER JOIN 
users ON posts.user_id = users.id 
LEFT JOIN 
comments ON posts.id = comments.post_id
LEFT JOIN 
likes ON posts.id = likes.post_id
GROUP BY 
posts.id, posts.content, users.username, users.id
ORDER BY 
posts.created_at DESC');

$show->execute([$user]);


while ($data = $show->fetch()) {
echo '<div class="post" id="post_' . $data['post_id'] . '">';
echo "<div class='username' onclick=\"";
if ($data['username'] === $_SESSION['username']) {
echo "window.location.href = 'profile.php';";
} else {
echo "window.location.href = 'info.php?id={$data['user_id']}';";
}
echo "\">";

if ($data['pdp'] === 'default') {
echo '<img src="uploads/default.png" alt="default Image">';
} else {
echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
}

echo "<div class='userdiv'>";
echo "<div class='usertop'>";
echo "<h3>" . htmlspecialchars($data['username']) . '</h3>';
if ($data['verified']) {
echo "<img src='icons/verified.png' class='verified'>";
}
echo "</div>";
echo "<span>" . $data['post_date'] . "</span>";
echo '</div>';
echo "</div>";
echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 

echo "<div class='reactions'>";
if ($data['liked_by_user'] > 0) { 

echo "<div onclick=\"window.location.href='dislike.php?id={$data['post_id']}'\">";
echo "<img class='like' src='icons/liked.png'> ";
echo '<span class="like-count">' . $data['likes_count'] . ' Likes</span>';
echo '</div>';
} else { 

echo "<div onclick=\"window.location.href='like.php?post_id={$data['post_id']}&owner_id={$data['user_id']}'\">";
echo "<img class='like' src='icons/like.png'> ";
echo '<span class="like-count">' . $data['likes_count'] . ' Likes</span>';
echo '</div>';
} 

echo "<div  onclick=\"window.location.href='postview.php?id={$data['post_id']}'\"><img src='icons/comment.png'> {$data['comments_count']} Comment</div> ";
echo "<div onclick=\"copyToClipboard('http://localhost/login/postview.php?id={$data['post_id']}')\"><img src='icons/share.png' > View post</div>";
echo "</div>";

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
    </div>

    <style>
     *{
        box-sizing: border-box;
        
     }
      
        
        .homeContainer {
            padding: 60px 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            min-height: 100vh;

        }
        .suggestions {
            position: absolute;
            top: 9%;
            z-index: 400;
            right: 4%;
        }

        .suggestions div:first-child {
            display: flex;
            justify-content: space-between;
         padding: 0 10px;
         margin-bottom: 5px;

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

        .reactions {
            
           
            cursor: pointer;
            color: #65676B;
            
            display: flex;
            justify-content: space-between;
        }
   

        .reactions img {
            height: 22px;
            width: 22px;
            margin-right: 5px;
            
        }

        .reactions div {
            display: flex;
            align-items: center;
            justify-content: center;
            
            flex: 1;
            border-radius: 4px;
            padding: 4px 0;
        }

        .reactions div:hover {
            background-color: #F2F2F2;
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
        
          .usertop {
            display: flex;
           align-items: center;
          }
        .usertop img {
            margin:0 3px;
            height: 14px;
            width: 14px;
           user-select: none;
         
           -webkit-user-drag: none;
            
        }
        .followed {
            display: none;
        }

        .like {
            height: 22px;
            width: 22px;
        }
        @media (max-width: 1180px) {

.suggestions {
display: none;
}
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


    function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Post link copied to clipboard');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }
</script>
</body>
</html>