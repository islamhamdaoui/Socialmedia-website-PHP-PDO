
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    require("auth.php");
    require("header.php");
    require("connection.php");


    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $show = $db->prepare("SELECT posts.id as post_id, posts.content, users.username ,users.id,users.pdp,users.verified,DATE(posts.created_at) as post_date
                         FROM posts 
                         INNER JOIN users ON posts.user_id = users.id 
                         WHERE posts.id = :id");

    $show->execute(array("id"=> $id));
    $data = $show->fetch();
    ?>
    <div class="postcontainer">
 
        <div class='post'>
            <div class="usertop">
            <?php
if ($data['pdp'] === 'default') {
    echo '<img src="uploads/default.png" alt="default Image">';
    } else {
    echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
    }
        ?>

                <b><?php echo htmlspecialchars($data["username"]); ?></b>
                <?php
                 if ($data['verified']) {
echo "<img src='icons/verified.png' class='verified'>";
} ?>

 <span><?=$data['post_date'] ?></span>
            </div>
            <span><?php echo htmlspecialchars($data["content"]); ?></span>
        </div>
    </div>

    <div class="comment">
        <form action="comment.php" method="post">
            <input type="text" name="comment" placeholder="Add new comment..." required id="input">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($data['post_id']); ?>">
            <input type="hidden" name="owner_id" value="<?php echo htmlspecialchars($data['id']); ?>">
            <input type="submit" value="Comment">
        </form>
 </div>
        <div class="comments">
            <?php
            
            $showComments = $db->prepare('
                SELECT 
                    comments.id as comment_id,
                    comments.created_at as created_at,
                    comments.comment,
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
                    echo "<div class='commentinfo'> ";
                    echo "<b onclick=\"mention('" . htmlspecialchars($comment['username']) . "')\" id='user'>" . htmlspecialchars($comment['username']) . "</b>";
                    echo htmlspecialchars($comment['comment']) . "<br>";
                    echo "<span class='date'>" . htmlspecialchars($comment['time_ago']) . "</span>";
                    echo "</div>";
                    if($comment['username'] === $_SESSION['username']){
echo "<div class='deletebtn' onclick=\"window.location.href='delete/deletecomment.php?id=" . $comment['comment_id'] . "&post_id=" . $data['post_id'] . "'\">Delete</div>";

                    }
                    echo "</div>";
                }
            } else {
                echo "No comments found for this post.";
            }
            ?>
        </div>
   

<script>
    function mention(username) {
            let input = document.getElementById('input');
            input.value = `@${username} `; // Append username to current input value
        }


        
</script>

<style>



*{
        box-sizing: border-box;
        margin: 0;
     }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }


        .postcontainer {
            padding-top: 50px;
        }

        .post {
            display: flex;
            flex-direction: column;
            width: 400px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #e0f2f1;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }


            .comment {
                display: flex;
            flex-direction: column;
            width: 400px;
            background-color: #e0f2f1;
            padding: 10px;
            }
        .comment form input {
            width: 100%;
    max-width: 350px;
    margin-bottom: 20px;
    height: 45px;
    border-radius: 8px;
    border: none;
    padding: 5px 10px;
    background-color: #fff;
    box-shadow: 1px 4px 5px rgba(0, 0, 0, 0.1);
        }


        .comment form input[type=submit] {
    background-color: #0866ff;
    color: #fff;
    font-weight: bold;
    width: 100%;
    margin-bottom: 5px;
    cursor: pointer;

} 
input[type=submit]:hover {
    opacity: 0.7;
}

.commentContainer {
    display: flex;
    width: 400px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            justify-content: space-between;
}
.commentinfo {
    display: flex;
            flex-direction: column;
            
}

.date {
    color: rgb(101, 103, 107);
    font-size: 12px;
}

.deletebtn {
    background-color: red;
    color: white;
    height: fit-content;
    padding: 5px 7px;
    cursor: pointer;
    font-size: 12px;
    border-radius: 8px;
   
}
.deletebtn:hover {
    opacity: 0.5;
}


.usertop {
            display: flex;
           align-items: center;
          }

          .usertop img {
            width: 38px;
            margin-right: 7px;
            height: 38px;
          }
        .usertop .verified {
            margin:0 3px;
            height: 14px;
            width: 14px;
           user-select: none;
         
           -webkit-user-drag: none;
            
        }
</style>
    
</body>
</html>

