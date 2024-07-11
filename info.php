<?php
 require("connection.php");
require("auth.php");
    $id = $_GET['id'];
 $select = $db -> prepare("SELECT * FROM users WHERE id=:id");
    $select -> execute(array(
        'id' => $id
    ));

    $data = $select->fetch();
?>

<?php
// following code
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
$follower_id = $_SESSION['user_id'];
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

$followersP = $db ->prepare ("SELECT users.id as id, users.username, users.email, users.pdp
    FROM users
    JOIN follow ON users.id = follow.follower_id
    WHERE follow.followed_id = :user_id");
    $followersP -> execute(array("user_id"=> $user_id));

    while($peoplefollow = $followersP -> fetch()){


?>
<div class="followersProfile" onclick="window.location.href = 'info.php?id=<?php echo $peoplefollow['id']; ?>'">
            
            <?php
if ($peoplefollow['pdp'] === 'default') {
echo '<img src="uploads/default.png" alt="default Image">';
} elseif ($peoplefollow['pdp'] === 'sara') {
echo "<img src='uploads/sara.png' alt='sara Image'>";
} elseif ($peoplefollow['pdp'] === 'dalia') {
echo "<img  src='uploads/dalia.png' alt='dalia Image'>";
}  elseif ($peoplefollow['pdp'] === 'islam') {
echo"<img src='uploads/islam.png' alt='islam Image'>";
}
elseif ($peoplefollow['pdp'] === 'mohamed') {
echo"<img class='image' src='uploads/mohamed.png' alt='mohamed Image'>";
} else {
echo '<img src="uploads/default.png" alt="default Image">';
}

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

$followingP = $db ->prepare ("SELECT users.id as id, users.username, users.email, users.pdp
    FROM users
    JOIN follow ON users.id = follow.followed_id
    WHERE follow.follower_id = :user_id");
    $followingP -> execute(array("user_id"=> $user_id));

    while($peopleIfollow = $followingP -> fetch()){


?>
<div class="followersProfile" onclick="window.location.href = 'info.php?id=<?php echo $peopleIfollow['id']; ?>'">
            
            <?php
if ($peopleIfollow['pdp'] === 'default') {
echo '<img src="uploads/default.png" alt="default Image">';
} elseif ($peopleIfollow['pdp'] === 'sara') {
echo "<img src='uploads/sara.png' alt='sara Image'>";
} elseif ($peopleIfollow['pdp'] === 'dalia') {
echo "<img  src='uploads/dalia.png' alt='dalia Image'>";
}  elseif ($peopleIfollow['pdp'] === 'islam') {
echo"<img src='uploads/islam.png' alt='islam Image'>";
}
elseif ($peopleIfollow['pdp'] === 'mohamed') {
echo"<img class='image' src='uploads/mohamed.png' alt='mohamed Image'>";
} else {
echo '<img src="uploads/default.png" alt="default Image">';
}

?>
                <div class="followersInfo" >
                <b><?php echo $peopleIfollow['username']; ?></b>
                <span><?php echo $peopleIfollow['email']; ?></span>
            </div>
            </div>
            <?php } ?>



    </div>

<div class="userprofile">


<div class="userpdp">
    <?php
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

?>
</div>
<div class="userinfo">

<h3><?php echo $data['username'] ?></h3> 
<span><?php echo $data['email'] ?></span> 

<?php if ($status !== 'followed') : ?>
    
<button id="follow" onclick="window.location.href='follow.php?followed_id=<?php echo $data['id']; ?>'">Follow</button>

<?php elseif($status == 'followed') : ?>
    <button id="unfollow" onclick="window.location.href='unfollow.php?followed_id=<?php echo $data['id']; ?>'">Unfollow</button>
    <?php endif; ?>
</div>
</div>

<div class="stats">
    <div >   
        <b><?php echo $followersCount['follower_num']; ?></b>
         <span>Posts</span>
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
    <?php

 $show = $db->prepare('SELECT posts.content, users.username 
 FROM posts 
 INNER JOIN users ON posts.user_id = users.id 
 WHERE users.id=:id ORDER BY posts.created_at DESC');



$show->execute(array('id' => $id));
              

while ($data = $show->fetch(PDO::FETCH_ASSOC)){
    echo '<div class="post">';
    echo '<h3>' . htmlspecialchars($data['username']) . '</h3>';
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    echo '</div>';
}
 

?>
    </div>
    </div>

    <style>
           *{
        box-sizing: border-box;
     }
   

        .infoContainer {
           
            width: 100%;
            padding: 50px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .stats {
    display: flex;
    width: 100%;
    max-width: fit-content;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
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


.userprofile {
        display: flex;
        width: 365px;
        margin: 30px 0 30px;
    }
    .userinfo {
        display: flex;
        flex-direction: column;
        margin-left: 15px;
    }

    .userinfo h3 {
font-size: xx-large;   
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
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);

   
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
    </style>





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
</script>
</body>
</html>