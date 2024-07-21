<?php
require("connection.php");
require("auth.php");
$id = null;
if (isset($_COOKIE["user_id"]) && isset($_COOKIE["username"])) {
    $id = $_COOKIE["user_id"];
    $username = $_COOKIE["username"];
    $respond = $db -> query("SELECT * FROM users");
    $column = $respond -> columnCount();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/home.css">
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
    <div class="filters">
        <div class="filter" id="allDiv" onclick="showAll()">For you</div>
        <div class="filter" id="followedDiv" onclick="showFollowed()">Following</div>
    </div>

    <div class="posts" id="all">
        <?php
        require("connection.php");

        $user = $_COOKIE["user_id"];

        //show all users posts in for you page
        $show = $db->prepare('SELECT 
        posts.id as post_id, 
        posts.content, 
        DATE(posts.created_at) as post_date, 
        users.username,
        users.verified, 
        users.pdp as pdp,
        users.id as user_id, 
        image,
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
            if ($id == 1) {
                echo "<div class='deleteBtn'><div onclick=\"window.location.href= 'delete/deletepost.php?post_id=".$data['post_id']."'\">Delete</div></div>";
            }
            echo "<div class='username' onclick=\"";
            if ($data['username'] === $_COOKIE['username']) {
                echo "window.location.href = 'profile.php';";
            } else {
                echo "window.location.href = 'profileview.php?id={$data['user_id']}';";
            }
            echo "\">";
            echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
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

            if ($data['image'] !== '') {
                echo "<img class='postImg' src='" . htmlspecialchars($data['image']) . "' alt='Image'>";
            }

            echo "<div class='reactions'>";
            //this code shows liked icon when user already liked it and the opposite
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

            echo "<div onclick=\"window.location.href='postview.php?id={$data['post_id']}'\"><img src='icons/comment.png'><span>{$data['comments_count']} Comment</span></div> ";
            echo "<div onclick=\"copyToClipboard('http://localhost/login/postview.php?id={$data['post_id']}')\"><img src='icons/share.png' ><span> Share</span></div>";
            echo "</div>";
            echo '</div>';
        }
        ?>
    </div>

    <div class="followed" id="followed">
        <?php
        require('connection.php');
        $follower_id = $_COOKIE['user_id'];

        //Shows only the posts from users that u follow
        $followed = $db->prepare('SELECT 
        posts.id AS post_id, 
        posts.content, 
        DATE(posts.created_at) AS post_date, 
        users.username,
        users.verified, 
        users.pdp AS pdp,
        users.id AS user_id, 
        posts.image, 
        COUNT(DISTINCT comments.id) AS comments_count, 
        COUNT(DISTINCT likes.id) AS likes_count,
        SUM(CASE WHEN likes.user_id = :follower_id THEN 1 ELSE 0 END) AS liked_by_user
        FROM 
        posts
        INNER JOIN 
        users ON posts.user_id = users.id 
        LEFT JOIN 
        comments ON posts.id = comments.post_id
        LEFT JOIN 
        likes ON posts.id = likes.post_id
        INNER JOIN 
        follow ON posts.user_id = follow.followed_id
        WHERE 
        follow.follower_id = :follower_id
        GROUP BY 
        posts.id, 
        posts.content, 
        posts.created_at, 
        users.username, 
        users.verified, 
        users.pdp, 
        users.id, 
        posts.image
        ORDER BY 
        posts.created_at DESC');

        $followed->execute(array("follower_id"=> $follower_id));

        if ($followed->rowCount() > 0) {
            while ($data = $followed->fetch()) {
                echo '<div class="post" id="post_' . $data['post_id'] . '">';
                echo "<div class='username' onclick=\"";
                if ($data['username'] === $_COOKIE['username']) {
                    echo "window.location.href = 'profile.php';";
                } else {
                    echo "window.location.href = 'profileview.php?id={$data['user_id']}';";
                }
                echo "\">";
                echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
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

                if ($data['image'] !== '') {
                    echo "<img class='postImg' src='" . htmlspecialchars($data['image']) . "' alt='Image'>";
                }

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
                echo "<div onclick=\"window.location.href='postview.php?id={$data['post_id']}'\"><img src='icons/comment.png'><span>{$data['comments_count']} Comment</span></div> ";
                echo "<div onclick=\"copyToClipboard('http://localhost/login/postview.php?id={$data['post_id']}')\"><img src='icons/share.png' ><span> Share</span></div>";
                echo "</div>";
                echo '</div>';
            }
        } else {
            echo "No friends posts found!";
        }
        ?>
    </div>
</div>



      
<script>
    function showAll(){
        document.getElementById("all").style.display = 'flex';
        document.getElementById("followed").style.display = 'none';
        document.getElementById("allDiv").style.background = '#F0F2F5';
      
        document.getElementById("followedDiv").style.background = '#fff';
        document.getElementById("allDiv").style.fontWeight = 'bold';
        document.getElementById("followedDiv").style.fontWeight = '100';
    }
    function showFollowed(){
        document.getElementById("all").style.display = 'none';
        document.getElementById("followed").style.display = 'flex';
        document.getElementById("allDiv").style.background = '#fff';
        document.getElementById("followedDiv").style.background = '#F0F2F5';
    
        document.getElementById("followedDiv").style.fontWeight = 'bold';
        document.getElementById("allDiv").style.fontWeight = '100';
    
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