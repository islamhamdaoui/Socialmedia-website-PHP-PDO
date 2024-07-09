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
$follower = $_SESSION['user_id'];
$following = $db -> prepare("SELECT count(followed_id) as following_num FROM follow WHERE follower_id = :follower_id");
$following -> execute(array("follower_id"=> $follower_id));

$followingCount = $following -> fetch();

?>


<?php
// following code
$followed = isset($_GET['followed']) && $_GET['followed'] === 'yes' ? 'yes' : '';
$followed_id = $_GET['id'];
$followers = $db -> prepare("SELECT count(follower_id) as follower_num ,status FROM follow WHERE followed_id = :followed_id");
$followers -> execute(array("followed_id"=> $followed_id));

$followersCount = $followers -> fetch();
$status = $followersCount['status'];
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

<?php elseif($status === 'followed') : ?>
    <button id="unfollow" onclick="window.location.href='unfollow.php?followed_id=<?php echo $data['id']; ?>'">Unfollow</button>
    <?php endif; ?>
</div>
</div>

<div class="stats">
    <div >   
        <b><?php echo $followersCount['follower_num']; ?></b>
         <span>Posts</span>
    </div>
     
     <div >
        <b><?php echo $followersCount['follower_num']; ?></b>
     <span>Followers</span>
     </div>  
     <div >
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


    <style>
           *{
        box-sizing: border-box;
     }
        body {
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
    </style>


<script>
    let followbtn =document.getElementById('follow')
    let unfollow =document.getElementById('unfollow')
    followbtn.addEventListener('click', function() {
    console.log("hi")
});
//  function follow(){
//     let follow =document.getElementById('follow')
//     let unfollow =document.getElementById('unfollow')
//     follow.style.display = 'none'
//     unfollow.style.display = 'block'

//     window.location.href='follow.php?followed_id=<?php echo $data['id']; ?>
//  }

 
//  function unfollow(){
//     let follow =document.getElementById('follow')
//     let unfollow =document.getElementById('unfollow')
//     follow.style.display = 'block'
//     unfollow.style.display = 'none'
//     window.location.href='unfollow.php?followed_id=<?php echo $data['id']; ?>
    
//  }
</script>
</body>
</html>