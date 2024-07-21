

<?php
require("auth.php");
require("connection.php");
// following code
$follower_id = $_COOKIE['user_id'];
$following = $db -> prepare("SELECT count(followed_id) as following_num FROM follow WHERE follower_id = :follower_id 

");
$following -> execute(array("follower_id"=> $follower_id));

$followingCount = $following -> fetch();
?>


<?php
// followers code
$followed_id = $_COOKIE['user_id'];
$followers = $db -> prepare("SELECT count(follower_id) as follower_num FROM follow WHERE followed_id = :followed_id");
$followers -> execute(array("followed_id"=> $followed_id));

$followersCount = $followers -> fetch();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/profile.css">

</head>
<body>
   

<?php
 require('header.php');

?>

<div class="profileContainer">

<div class="followers" id="followers">
    <div class="close">
    <img onclick="closeFollowers()" src="icons/close.png" alt="close">
    </div>
    <b>Followers</b><br>
    <?php

$user_id = $_COOKIE['user_id'];

//shows ur followers
$followersP = $db ->prepare ("SELECT users.id as id, users.username, users.email, users.pdp
    FROM users
    JOIN follow ON users.id = follow.follower_id
    WHERE follow.followed_id = :user_id
    ORDER BY id DESC
    ");
    $followersP -> execute(array("user_id"=> $user_id));

    while($peoplefollow = $followersP -> fetch()){


?>
<div class="followersProfile" onclick="window.location.href = 'info.php?id=<?php echo $peoplefollow['id']; ?>'">
            
            <?php
            

echo "<img src='uploads/{$peoplefollow['pdp']}.png' alt='{$peoplefollow['pdp']} Image'>";


?>
                <div class="followersInfo" >
                <b><?php echo $peoplefollow['username']; ?></b>
                <span><?php echo $peoplefollow['email']; ?></span>
            </div>
            </div>
            <?php } ?>

</div>


    <div class="followers" id="following">

    <div class="close">
    <img onclick="closeFollowing()" src="icons/close.png" alt="close">
    </div>
    <b>following</b><br>
    <?php

$user_id = $_COOKIE['user_id'];

//shows people that u follow
$followingP = $db ->prepare ("SELECT users.id as id, users.username, users.email, users.pdp
    FROM users
    JOIN follow ON users.id = follow.followed_id
    WHERE follow.follower_id = :user_id
    ORDER BY id DESC
    ");
    $followingP -> execute(array("user_id"=> $user_id));

    while($peopleIfollow = $followingP -> fetch()){


?>
<div class="followersProfile" onclick="window.location.href = 'info.php?id=<?php echo $peopleIfollow['id']; ?>'">
            
            <?php

 echo "<img src='uploads/{$peopleIfollow['pdp']}.png' alt='{$peopleIfollow['pdp']} Image'>";



?>
                <div class="followersInfo" >
                <b><?php echo $peopleIfollow['username']; ?></b>
                <span><?php echo $peopleIfollow['email']; ?></span>
            </div>
            </div>
            <?php } ?>



    </div>


<div class="userprofile">

<?php
 require("connection.php");



 $id = $_COOKIE['user_id'];
 //shows ur profile info
 $select = $db ->prepare("SELECT * FROM users WHERE id= :id");
 $select -> execute(array("id"=> $id));


    $data = $select -> fetch();
    
?>
    <div class="userpdp">
        <?php

        
echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";


?>
    </div>
    <div class="userinfo">
    <div class="usertop">

        <h3><?php echo $data['username'] ?></h3> 
        <?php
if($data['verified']) {
    echo "<img src='icons/verified.png' class='verified'>";
} ?>
    </div>
        <span><?php echo $data['email'] ?></span> 
    <button onclick="location.href='editform.php'">Edit profile</button>
    </div>
    </div>


    <div class="stats">
    <div >   
        <b><?php 
        $id = $_COOKIE['user_id'];
        //shows how many likes u have in all ur posts
        $likes = $db -> prepare('SELECT COUNT(id) as likes_num FROM likes WHERE owner_id = :user_id');
        $likes -> execute(array('user_id'=> $id));
        $liked = $likes -> fetch();
        echo $liked['likes_num'];
        ?></b>
         <span>Likes</span>
    </div>
     
     <div onclick="showFollowers()">
        <b><?php echo $followersCount['follower_num']; ?></b>
     <span>Followers</span>
     </div>  
     <div onclick="showFollowing()">
     <b> <?php echo $followingCount['following_num']; ?> </b>
     <span>Following</span>
     </div>

    </div>
  
    

    <div class="addpost" >
    <form action="post.php" method="post" enctype="multipart/form-data">
    <div class="input">
        <?php
      echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";

        ?>
        
        <textarea name="content" placeholder="Add new post..." required></textarea>
    </div>
    
    <div class="btn">
        <input type="file" name="files[]" multiple />
        <input type="submit" value="Add">
    </div>
</form>

    </div>
    
    <div class="posts">
      <div style="max-width: 470px; width:100%;"><h3 style="margin-top: 0;">Your posts</h3></div>
    <?php
$userid = $_COOKIE['user_id'];

// shows all ur posts
$show = $db->prepare('SELECT 
posts.id as post_id, 
posts.content, 
DATE(posts.created_at) as post_date, 
users.username,
users.verified, 
users.pdp ,
users.id as user_id, 
image,
COUNT(DISTINCT comments.id) as comments_count, 
COUNT(DISTINCT likes.id) as likes_count,
SUM(CASE WHEN likes.user_id = :user_id THEN 1 ELSE 0 END) as liked_by_user
FROM 
posts 
INNER JOIN 
users ON posts.user_id = users.id 
LEFT JOIN 
comments ON posts.id = comments.post_id
LEFT JOIN 
likes ON posts.id = likes.post_id
 WHERE users.id = :user_id
GROUP BY 
posts.id, posts.content, users.username, users.id, users.pdp
ORDER BY 
posts.created_at DESC');




$show->execute([':user_id' => $userid]);
              

if($show->rowCount() > 0){
while ($data = $show->fetch(PDO::FETCH_ASSOC)){

    
    echo '<div class="post">';
    echo "<div class='username'>";
    
    echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";

    echo "<div class='userdiv' >";
    echo "<h3 >" . htmlspecialchars($data['username']) . '</h3>';
    echo "<span>" .$data['post_date'] . "</span>";
    echo '</div>';

    echo "<div class='deleteBtn'><div onclick=\"window.location.href= 'delete/deletepost.php?post_id=".$data['post_id']."'\">Delete</div></div>";
    echo "</div>";

    
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    if ( $data['image'] !== '') {
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

    echo "<div><div class='comment' onclick=\"window.location.href='postview.php?id={$data['post_id']}'\">{$data['comments_count']} Comment</div> </div>";
    echo "<div onclick=\"copyToClipboard('http://localhost/login/postview.php?id={$data['post_id']}')\"><img src='icons/share.png' ><span> Share</span></div>";
 
    echo '</div>';
    echo '</div>';
}
}else {
    echo "You haven't posted anything yet.";

}

?>
    </div>
    </div>

 


<script>
    function closeFollowers() {
        
 let followers =document.getElementById('followers')

 followers.style.display = 'none'
    }

    function showFollowers() {
        let followers =document.getElementById('followers')
        let following =document.getElementById('following')
        
 followers.style.display = 'flex'
 following.style.display = 'none'
 
    }
    function closeFollowing() {
        
 let followers =document.getElementById('following')

 following.style.display = 'none'
    }

    function showFollowing() {
        let following =document.getElementById('following')
        let followers =document.getElementById('followers')

 following.style.display = 'flex'
 followers.style.display = 'none'
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