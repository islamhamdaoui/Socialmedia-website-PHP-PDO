
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.notification {
    display: flex;
    padding: 5px 10px;
    cursor: pointer;
    /* border-radius: 8px; */
    width: 100%;
    max-width: 320px; 
    word-wrap: break-word; 
   
}

.unread {
    background-color: #E4E6E9;
}

.notification .message {
    display: block; 
    overflow: hidden;
    white-space: normal; 
}

.notification span:nth-child(2){
    color: rgb(101, 103, 107);
    font-size: 13px;
}


        .notification:hover {
            background-color: #E4E6E9;
        }
        .notification img {
            width: 38px;
            margin-right: 7px;
            height: 38px;
        }
       

        .notification div {
            display: flex;
            flex-direction: column;
           
        }
  
    </style>
</head>
<body>

<?php
require("connection.php");

session_start();
$user_id = $_SESSION['user_id'];

$notifications = $db->prepare('SELECT 
    notifications.message,
    users.pdp,
    notifications.post_id,
    TIMESTAMPDIFF(SECOND, notifications.created_at, NOW()) AS seconds_ago,
    notifications.user_id,
    notifications.id,
    is_read,
    
    CASE
        WHEN TIMESTAMPDIFF(SECOND, notifications.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(SECOND, notifications.created_at, NOW()), "s ago")
        WHEN TIMESTAMPDIFF(MINUTE, notifications.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, notifications.created_at, NOW()), "m ago")
        WHEN TIMESTAMPDIFF(HOUR, notifications.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, notifications.created_at, NOW()), "h ago")
        ELSE CONCAT(TIMESTAMPDIFF(DAY, notifications.created_at, NOW()), "d ago")
    END AS time_ago
FROM notifications
INNER JOIN users ON notifications.user_id = users.id
WHERE owner_id = :user_id AND user_id != :user_id

ORDER BY notifications.created_at DESC');



$notifications -> execute(array('user_id'=> $user_id));
if($notifications->rowCount() > 0) {
    while($data = $notifications -> fetch()) {
        if($data['is_read'] ==='YES')  {

       
        if ($data['post_id']=== NULL){
            echo "<div class='notification' onclick=\"window.location.href='notificationClicked.php?user_id={$data['user_id']}&id={$data['id']}'\">";
          
        }else {

       
        echo "<div class='notification' onclick=\"window.location.href='notificationClicked.php?post_id={$data['post_id']}&id={$data['id']}'\">";
    }
        echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
        echo "<div>";
        echo "<span class='message'>". $data['message'] . "</span>";
        echo "<span>". $data['time_ago'] . "</span>";
      
      
       
        echo "</div>";
        echo "</div>";
    } else {
        if ($data['post_id']=== NULL){
            echo "<div class='notification unread' onclick=\"window.location.href='notificationClicked.php?user_id={$data['user_id']}&id={$data['id']}'\">";
          
        }else {

       
        echo "<div class='notification unread' onclick=\"window.location.href='notificationClicked.php?post_id={$data['post_id']}&id={$data['id']}'\">";
    }
        echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
        echo "<div>";
        echo "<span class='message'>". $data['message'] . "</span>";
        echo "<span>". $data['time_ago'] . "</span>";
      
      

        echo "</div>";
        echo "</div>";
    }
}
    } else {

        echo "<div style='width:100%; height:200px; display:flex; align-items: center;justify-content: center;'>All caught up! No new notifications.</div>";
    
}

    

    
?>
    
</body>
</html>