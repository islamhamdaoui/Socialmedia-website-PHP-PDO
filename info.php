

<?php
// following code
require("connection.php");
require("auth.php");
$follower_id = $_GET['id'];

$following = $db -> prepare("SELECT count(followed_id) as following_num  FROM follow WHERE follower_id = :follower_id");
$following -> execute(array(
    "follower_id"=> $follower_id,
    


));



$followingCount = $following -> fetch();


?>


<?php
// followers code
$status = '';
$followed_id = $_GET['id'];

$followers = $db -> prepare("SELECT count(follower_id) as follower_num FROM follow WHERE followed_id = :followed_id");
$followers -> execute(array("followed_id"=> $followed_id));

$followersCount = $followers -> fetch();

?>

<?php
// status code
$follower_id = $_COOKIE['user_id'];
$followed_id = $_GET['id'];

$statusRespond = $db->prepare("SELECT status FROM follow WHERE follower_id = :follower_id and followed_id = :followed_id" );
$statusRespond->execute(array(

    
    "follower_id" => $follower_id,
    "followed_id" => $followed_id

));

if ($statusRespond->rowCount() > 0) {
    $statusf = $statusRespond->fetch();
    $status = $statusf['status'];
} 
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/info.css">
</head>
<body>

<?php
  require('header.php');
?>

<div class="infoContainer">



<div class="followers" id="followers">
    <div class="close">
    <img onclick="closeFollowers()" src="icons/close.png" alt="close">
    </div>
    <b>Followers</b><br>
    <?php

$user_id = $_GET['id'];
//this shows the people that are following this user
$followersP = $db ->prepare ("SELECT users.id as id, users.username, users.email, users.pdp
    FROM users
    JOIN follow ON users.id = follow.follower_id
    WHERE follow.followed_id = :user_id");
    $followersP -> execute(array("user_id"=> $user_id));

    while($peoplefollow = $followersP -> fetch()){


?>
<div class="followersProfile" onclick="window.location.href = 'info.php?id=<?php echo $peoplefollow['id']; ?>'">
            
            <?php
 //shows followers image
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

$user_id = $_GET['id'];
//this shows the people that this user is following
$followingP = $db ->prepare ("SELECT users.id as id, users.username, users.email, users.pdp
    FROM users
    JOIN follow ON users.id = follow.followed_id
    WHERE follow.follower_id = :user_id");
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
    $id = $_GET['id'];
    //this code to show the user info --the one that u opened his profile
 $select = $db -> prepare("SELECT * FROM users WHERE id=:id");
    $select -> execute(array(
        'id' => $id
    ));

    $data = $select->fetch();
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

<!-- this code will show u follow button if u didnt follow that user yet and the oposite -->
<?php if ($status !== 'followed') : ?>
    
<button id="follow" onclick="window.location.href='follow.php?followed_id=<?php echo $data['id']; ?>'">Follow</button>

<?php elseif($status == 'followed') : ?>
    <button id="unfollow" onclick="window.location.href='unfollow.php?followed_id=<?php echo $data['id']; ?>'">Unfollow</button>
    <?php endif; ?>
</div>
</div>

<div class="stats">
    <div >   
        <b>
        <?php 
          $id = $_GET['id'];
          //this code shows how many likes this user got from all his posts
        $likes = $db -> prepare('SELECT COUNT(id) as likes_num FROM likes WHERE owner_id = :user_id');
        $likes -> execute(array('user_id'=> $id));
        $liked = $likes -> fetch();
        echo $liked['likes_num'];
        ?>
        </b>
         <span>Likes</span>
    </div>
     
     <div  onclick="showFollowers()">
        <b><?php echo $followersCount['follower_num']; ?></b>
     <span>Followers</span>
     </div>  
     <div  onclick="showFollowing()">
     <b> <?php echo $followingCount['following_num']; ?> </b>
     <span>Following</span>
     </div>

    </div>
     
    <div class="posts">
    <div style="max-width: 470px; width:100%;"><h3 style="margin-top: 0;">Posts</h3></div>
    <?php



$liker_id = $_COOKIE['user_id'];
//shows this user posts
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
SUM(CASE WHEN likes.user_id = :liker_id THEN 1 ELSE 0 END) as liked_by_user
FROM 
posts 
INNER JOIN 
users ON posts.user_id = users.id 
LEFT JOIN 
comments ON posts.id = comments.post_id
LEFT JOIN 
likes ON posts.id = likes.post_id
 WHERE users.id = :id
GROUP BY 
posts.id, posts.content, users.username, users.id, users.pdp
ORDER BY 
posts.created_at DESC');

$show->execute(array('id' => $id,
'liker_id'=> $liker_id
));
              
if($show->rowCount() > 0) {


while ($data = $show->fetch(PDO::FETCH_ASSOC)){
    echo '<div class="post">';
    echo "<div class='username'>";
    
    echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";

    echo "<div class='userdiv' >";
    echo "<h3 >" . htmlspecialchars($data['username']) . '</h3>';
    echo "<span>" .$data['post_date'] . "</span>";
    echo '</div>';

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
} else {
   echo "It looks like this user hasn't shared anything.";
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
        followers.style.display = 'flex'
           }
           function closeFollowing() {
               
        let followers =document.getElementById('following')
       
        following.style.display = 'none'
           }
       
           function showFollowing() {
               let following =document.getElementById('following')
        following.style.display = 'flex'
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