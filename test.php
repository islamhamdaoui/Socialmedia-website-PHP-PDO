<?
// Assuming session start and user_id assignment are done before this code segment

// Ensure $user contains the correct user ID
$user = $_SESSION["user_id"];

// Prepare and execute the SQL query
$show = $db->prepare('SELECT posts.id as post_id, posts.content, DATE(posts.created_at) as post_date, users.username, users.id as user_id, likes.user_id as liker_id, users.pdp, likes.status as liked, COUNT(DISTINCT comments.id) as comments_count, COUNT(DISTINCT likes.user_id) as likes_count
                   FROM posts 
                   INNER JOIN users ON posts.user_id = users.id 
                   LEFT JOIN comments ON posts.id = comments.post_id
                   LEFT JOIN likes ON posts.id = likes.post_id AND likes.user_id = :user_id
                   GROUP BY 
                        posts.id, posts.content, users.username, users.id, users.pdp
                   ORDER BY posts.created_at DESC');
$show->execute(array('user_id' => $user));

// Display posts and user information
while ($data = $show->fetch()) {
    echo '<div class="post" id="post_' . $data['post_id'] . '">';
    echo "<div class='username' onclick=\"";
    if ($data['username'] === $_SESSION['username']) {
        echo "window.location.href = 'profile.php';";
    } else {
        echo "window.location.href = 'info.php?id={$data['user_id']}';";
    }
    echo "\">";
    
    if ($data['pdp'] === 'default') {
        echo '<img src="uploads/default.png" alt="default Image">';
    } else {
        echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
    }

    echo "<div class='userdiv'>";
    echo "<h3>" . htmlspecialchars($data['username']) . '</h3>';
    echo "<span>" . $data['post_date'] . "</span>";
    echo '</div>';

    echo "</div>";
    echo '<p>' . htmlspecialchars($data['content']) . '</p>'; 
    
    echo "<div class='reactions'>";
    // Check if the post is liked and not liked by the owner
    if ($data["liked"] === 'liked' && $data['liker_id'] == $user && $data['user_id'] !== $user ) { 
        echo "<div onclick=\"window.location.href='dislike.php?id={$data['post_id']}'\">";
        echo "<img class='like' src='icons/liked.png'> ";
        echo '<span class="like-count">' . $data['likes_count'] . ' Likes</span>';
        echo '</div>';
    } elseif ($data['user_id'] !== $user) { // Display like button if the user is not the owner
        echo "<div onclick=\"window.location.href='like.php?post_id={$data['post_id']}&owner_id={$data['user_id']}'\">";
        echo "<img class='like' src='icons/like.png'> ";
        echo '<span class="like-count">' . $data['likes_count'] . ' Likes</span>';
        echo '</div>';
    } else { // Display like count only to the post owner
        echo '<div>';
        echo '<span class="like-count">' . $data['likes_count'] . ' Likes</span>';
        echo '</div>';
    }
    
    echo "<div onclick=\"window.location.href='postview.php?id={$data['post_id']}'\"><img src='icons/comment.png'> {$data['comments_count']} Comment</div>";
    echo "<div><img src='icons/view.png'> View post</div>";
    echo "</div>";
    
    echo '</div>'; // closing post div
}

echo '</div>'; // closing main container div
