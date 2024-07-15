
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
    <div class="container">
 
        <div class='post'>
          <div class="username">
            <?php
if ($data['pdp'] === 'default') {
    echo '<img src="uploads/default.png" alt="default Image">';
    } else {
    echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
    }
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
                    if($comment['username'] === $_SESSION['username']){
                        echo'<div class="deletebtn">';
echo "<div  onclick=\"window.location.href='delete/deletecomment.php?id=" . $comment['comment_id'] . "&post_id=" . $data['post_id'] . "'\">Delete</div>";
echo"</div>";
                    }
                    echo "<div class='commentDiv'>";
                    echo "<img src='uploads/{$comment['pdp']}.png' alt='{$comment['pdp']} Image'>";

                    echo" <div class='commentContent'>";
                    echo "<div class='commentinfo'> ";
                    echo "<div class='commentTop'> ";

                    echo "<b onclick=\"mention('" . htmlspecialchars($comment['username']) . "')\" id='user'>" . htmlspecialchars($comment['username']) . "</b>";
                    if ($comment['verified']) {
                        echo "<img src='icons/verified.png' class='verified'>";
                    }
                    echo "</div>";
                    echo htmlspecialchars($comment['comment']) . "<br>";
                    echo "</div>";
                    echo "<span class='date'>" . htmlspecialchars($comment['time_ago']) . "</span>";
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
            input.value = `@${username} `; // Append username to current input value
        }


        
</script>

<style>



*{
        box-sizing: border-box;

     }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }


        .container {
           margin-top: 70px;
          
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
            
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }


            .comment {
                display: flex;
            flex-direction: column;
            width: 100%;
            max-width:470px ;
           margin-top: 6px;
           
            }
   
        .comment form input {
            width: 100%;

   flex: 4;
    margin-bottom: 20px;
    height: 45px;
    border-radius: 8px 0 0 8px;
    border: none;
    padding: 0 15px;
    outline: none;
    
    background-color: #fff;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

form {
    height: 53px;
    display: flex;
}
        .comment form input[type=submit] {
    background-color: #0866ff;
    color: #fff;
   
    font-weight: bold;
    border-radius: 0px 8px 8px 0;
   
    margin-bottom: 5px;
    flex: 1;
    cursor: pointer;

} 
input[type=submit]:hover {
    opacity: 0.7;
  
}

.comments {
    
    width: 100%;
   
    max-width: 470px;
    padding: 10px 7px;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}

.commentContainer {
    display: flex;
    width: 100%;
    max-width: 450px;
    flex-direction: column;
            padding: 5px 0;
           
            
            border-radius: 8px;
          
          
}
.commentinfo {
    display: flex;
            flex-direction: column;
            background-color:#f6f6f6;
            background-color: #e5ecf7;
            padding: 8px 12px;
          
            border-radius: 18px;
            
}

.commentinfo b {
   
}

.commentContainer img {
    width: 38px;
            margin-right: 7px;
            height: 38px;
}

img.verified {
    
            margin:0 3px;
            height: 14px;
            width: 14px;
           user-select: none;
         
           -webkit-user-drag: none;
            
        }


.commentDiv {
  
    display: flex;
    
}

.date {
    color: rgb(101, 103, 107);
    font-size: 12px;
}
.deletebtn {
    width:100%;
    max-width: 400px;

}

.deletebtn div{
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
.deletebtn div:hover {
    opacity: 0.5;
}


.username {
            display: flex;
            align-items: center;
}
.usertop {
            display: flex;
           align-items: center;
          }

          .post img {
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

        .userdiv span {
            font-size: 12px;
            color: rgb(101, 103, 107);
        }
        .userdiv {
            display: flex;
            flex-direction: column;
        }

</style>
    
</body>
</html>

