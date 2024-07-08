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
    <div>
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
    <b>Username: </b>
    <span><?php echo $data['username'];  ?></span> <br><br>
    <b>Email: </b>
    <span><?php echo $data['email'];  ?></span>
    <button id="follow" onclick="window.location.href='follow.php?followed_id=<?php echo $data['id']; ?>'">Follow</button>
    <button id="unfollow" onclick="window.location.href='unfollow.php?followed_id=<?php echo $data['id']; ?>'">Unfollow</button>

     
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
    </style>


<script>

 function follow(){
    let follow =document.getElementById('follow')
    let unfollow =document.getElementById('unfollow')
    follow.style.display = 'none'
    unfollow.style.display = 'block'

    window.location.href='follow.php?followed_id=<?php echo $data['id']; ?>
 }

 
 function unfollow(){
    let follow =document.getElementById('follow')
    let unfollow =document.getElementById('unfollow')
    follow.style.display = 'block'
    unfollow.style.display = 'none'
    window.location.href='unfollow.php?followed_id=<?php echo $data['id']; ?>
    
 }
</script>
</body>
</html>