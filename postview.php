
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialDZ</title>
    <link rel="stylesheet" href="styles/postview.css">
    
</head>
<body>
<?php
    require("auth.php");
    require("header.php");
    require("connection.php");


    $id = isset($_GET['id']) ? $_GET['id'] : null;
    //this code to show the user post that u opened
    $show = $db->prepare("SELECT posts.id as post_id, posts.content, users.username ,users.id,users.pdp,users.verified,DATE(posts.created_at) as post_date,image
                         FROM posts 
                         INNER JOIN users ON posts.user_id = users.id 
                         WHERE posts.id = :id");

    $show->execute(array("id"=> $id));
    $data = $show->fetch();
    ?>
    <div class="container">
 
        <div class='post'>
          <div class="username">
            <?php

    echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
   
        ?>
                <div class="userdiv">
                <div class="usertop">
                    <b><?php echo htmlspecialchars($data["username"]); ?></b>
                    <?php
                 if ($data['verified']) {
                     echo "<img src='icons/verified.png' class='verified'>";
                    } ?>



</div>
<span><?=$data['post_date'] ?></span>
</div>
</div>
            <p><?php echo htmlspecialchars($data["content"]); ?></p>
            <?php if ( $data['image'] !== '') {
    echo "<img class='postImg' src='" . htmlspecialchars($data['image']) . "' alt='Image'>";
}
 ?>
        
    </div>
   
    <div class="comment">
        <form action="comment.php" method="post">
            <input type="text" name="comment" placeholder="Add new comment..." required id="input">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($data['post_id']); ?>">
            <input type="hidden" name="owner_id" value="<?php echo htmlspecialchars($data['id']); ?>">
           <input type="submit" value="Comment" >
        </form>
 </div>
        <div class="comments">
            <?php
            //shows all comments for this post
            $showComments = $db->prepare('
                SELECT 
                    comments.id as comment_id,
                    comments.created_at as created_at,
                    comments.comment,
                    pdp,
                    verified,
                    users.username,

    
                    TIMESTAMPDIFF(SECOND, comments.created_at, NOW()) AS seconds_ago,
                    CASE
                        WHEN TIMESTAMPDIFF(SECOND, comments.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(SECOND, comments.created_at, NOW()), \'s ago\')
                        WHEN TIMESTAMPDIFF(MINUTE, comments.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, comments.created_at, NOW()), \'m ago\')
                        WHEN TIMESTAMPDIFF(HOUR, comments.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, comments.created_at, NOW()), \'h ago\')
                        ELSE CONCAT(TIMESTAMPDIFF(DAY, comments.created_at, NOW()), \'d ago\')
                    END AS time_ago
                FROM 
                    comments 
                INNER JOIN 
                    users ON comments.user_id = users.id 
                WHERE 
                    comments.post_id = :post_id
                ORDER BY 
                    comments.created_at DESC
            ');

            $showComments->execute(array('post_id' => $id));

            if ($showComments->rowCount() > 0) {
                while ($comment = $showComments->fetch(PDO::FETCH_ASSOC)) {
                   
                    echo "<div class='commentContainer'>";
                    if($comment['username'] === $_COOKIE['username']){
                        echo'<div class="deletebtn">';
echo "<div  onclick=\"window.location.href='delete/deletecomment.php?id=" . $comment['comment_id'] . "&post_id=" . $data['post_id'] . "'\">Delete</div>";
echo"</div>";
                    }
                    echo "<div class='commentDiv'>";
                    echo "<img src='uploads/{$comment['pdp']}.png' alt='{$comment['pdp']} Image'>";

                    echo" <div class='commentContent'>";
                    echo "<div class='commentinfo'> ";
                    echo "<div class='commentTop'> ";

                    echo "<b id='user'>" . htmlspecialchars($comment['username']) . "</b>";
                    if ($comment['verified']) {
                        echo "<img src='icons/verified.png' class='verified'>";
                    }
                    echo "</div>";
                    echo htmlspecialchars($comment['comment']) . "<br>";
                    echo "</div>";
                    echo "<span class='date'>" . htmlspecialchars($comment['time_ago']) . "</span>";
                    echo "<span class='reply'  onclick=\"mention('" . htmlspecialchars($comment['username']) . "')\">Reply</span>";
                    echo "</div>";
                   
                    echo "</div>";
       
                    echo "</div>";
                }
            } else {
                echo "No comments found for this post.";
            }
            
            ?>
            
        </div>
   
</div>
<script>
    
    function mention(username) {
            let input = document.getElementById('input');
            input.value = `@${username} `; 
        }



</script>

</body>
</html>

