<?php
session_start();
require("connection.php");

// Check if $_SESSION['post_id'] is set and $_GET['post_id'] is set
if (isset($_SESSION['post_id']) && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Prepare and execute SQL query to fetch comments for the specified post_id
    $show = $db->prepare('
        SELECT comments.id as comment_id, comments.comment, users.username
        FROM comments
        INNER JOIN users ON comments.user_id = users.id
        WHERE comments.post_id = :post_id
        ORDER BY comments.created_at DESC
    ');
    $show->execute(array('post_id' => $post_id));

    // Check if there are comments for the given post_id
    if ($show->rowCount() > 0) {
        // Loop through each fetched comment
        while ($comment = $show->fetch(PDO::FETCH_ASSOC)) {
            echo htmlspecialchars($comment['username']) . "<br>";
            echo htmlspecialchars($comment['comment']) . "<br>";
        }
    } else {
        echo "No comments found for this post.";
    }
} else {
    echo "No post_id specified or post_id not set in session."; // Handle case where post_id is not provided
}
?>
