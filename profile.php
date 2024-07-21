

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
    <style>
     *{
        box-sizing: border-box;
     }
        body {
            padding: 0;
            position: relative;
           
        }
        .profileContainer {
           
            width: 100%;
            padding: 50px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .addpost {
            max-width: 470px;
            width: 100%;
            display: flex;
           
            justify-content: center;
            background-color: #fff;
            flex-direction: column;
            margin-top: 50px;
            padding: 10px 10px;
            border-radius: 8px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .addpost .btn {
            width: 100%;
            margin-top: 10px;
        }
        .input {
            display: flex;
            justify-content: center;
        }

        .input img {
            height: 48px;
            width: 48px;
            margin-right: 7px;

        }

        .addpost form textarea {
            width: 100%;
    min-height: 70px; 
   
    
    padding: 10px;
    resize: none; 
    outline: none;
    border: none;
    font-size: 16px; 
    line-height: 1.5; 
    box-sizing: border-box;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    
        }

        .addpost form input[type=submit] {
    background-color: #0866ff;
    border: none;
   border-radius:100px;
    padding: 10px 40px;
    color: #fff;
    font-weight: bold;
    float: right;
   
    margin-bottom: 5px;
    cursor: pointer;

} 
input[type=submit]:hover {
    opacity: 0.7;
 
}



.postImg {
            max-width: 100%;
    height: auto;
    display: block; 
    margin: auto;
    border-top: 1px solid rgba(0, 0, 0 , 0.1);
    border-bottom: 1px solid rgba(0, 0, 0 , 0.1);
        }

.stats {
    display: flex;
    width: 100%;
    max-width: fit-content;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.stats div {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 7px 25px;
    cursor: pointer;
    width: 115px;

}

.stats div:hover {
    background-color: #f0f2f5;
}

.stats div:first-child {
    cursor: text;
}
.stats div:nth-child(2) {
   
    border-left: 1px solid rgba(0, 0, 0, 0.1);
    border-right: 1px solid rgba(0, 0, 0, 0.1);

}





    .userprofile {
        display: flex;
        max-width: 365px;
        width: 100%;
        margin: 30px 0 30px;
    }
    .userinfo {
        display: flex;
        flex-direction: column;
        margin-left: 15px;
    }

    .userinfo h3 {
font-size: 2rem;   
margin: 0;


}

.userinfo button {
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    border-radius: 4px;
    width: fit-content;
    padding: 5px 35px;
    background-color:#fff;
    border: none;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);

   
}
    .userpdp img {
        width: 150px;
        height: 150px;
    }


    .followers {
        display: none;
        flex-direction: column;
        position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    width: 360px;
    padding: 20px;
    border-radius: 8px;
        max-height: calc(100vh - 190px);
        overflow-y: scroll;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    z-index: 1000;


    }

    .followers img {
        height: 48px;
        width: 48px;
    }

    .followersProfile {
        display: flex;
        border-radius: 8px;
        padding: 5px;
        margin-bottom: 7px;
        cursor: pointer;
    }

    .followersProfile:hover {
     background-color: #e4e4e4;
    }

    .followersInfo {
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-left: 10px;
    }
  

    .close {
        width: 100%;
        margin-bottom: 5px;
    }
    .close img {
        height: 25px;
        width: 25px;
        cursor: pointer;
       float: right;
    }

     
    .posts {
            margin-top: 50px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
           padding: 0 10px;
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
            height: 18px;
            width: 18px;
           user-select: none;
         
           -webkit-user-drag: none;
            
        }

        .reactions {
            
           
            cursor: pointer;
            color: #65676B;
            margin-top: 5px;
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

        .deleteBtn {
    width:100%;
    max-width: 400px;

}

.deleteBtn div{
    background-color: red;
    color: white;
  
    float: right;
    height: fit-content;
    padding: 5px 7px;
    cursor: pointer;
    font-size: 12px;
    border-radius: 8px;
    margin-right: 0;
    margin-left: auto;
   
}
.deleteBtn div:hover {
    opacity: 0.5;
}


        @media (max-width: 768px) {

            .userpdp img {
        width: 90px;
        height: 90px;
    }

    
    .userinfo h3 {
font-size: 1.6rem;   

}


.userinfo span {
font-size: 14px;    



}
        }
    </style>

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