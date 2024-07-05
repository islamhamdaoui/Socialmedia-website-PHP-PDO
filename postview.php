
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 require("header.php");

?>

<div class="postcontainer">
<?php 

require("connection.php");

$id = $_GET['id'];

$show = $db ->prepare("SELECT posts.id as post_id, posts.content, users.username ,users.id
 FROM posts 
 INNER JOIN users ON posts.user_id = users.id where posts.id = :id");

 $show -> execute(array("id"=> $id));

 $data = $show -> fetch();
echo "<div class='post'>";
 echo "<b>" . $data["username"] . "</b>";
 echo "<span>" . $data["content"] . "</span>";

 echo "</div>";

 ?>
</div>
<div class="comment">
    <form action="comment.php" method="post">
        <input type="text" name="comment" placeholder="Add new comment..." required>
        <input type="hidden" name="post_id" value="<?php echo $data['post_id'];  ?>">
        <input type="submit" value="Comment" onclick="window.location.href='postview.php?id={$data['post_id']}'">
        <div class="comments">


<?php
session_start();
require("connection.php");
if (isset($_SESSION['post_id'])) {
    $post_id = $_GET['id'];

    


    $show = $db->prepare('SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at DESC');
    $show->execute(array('post_id' => $post_id));

    // Check if there are comments for the given post_id
    if ($show->rowCount() > 0) {
        // Loop through each fetched comment
        while ($comment = $show->fetch(PDO::FETCH_ASSOC)) {
            echo htmlspecialchars($comment['comment']) . "<br>";
            echo htmlspecialchars($comment['comment']) . "<br>";
        }
    } else {
        echo "No comments found for this post.";
    }
} else {
    echo "No post_id set in session."; // Handle case where $_SESSION['post_id'] is not set
}
?>


        </div>
    </form>
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
</style>
    
</body>
</html>

