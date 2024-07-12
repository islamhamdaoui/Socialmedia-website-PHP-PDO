
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
    border-radius: 8px;
    width: 100%;
    max-width: 320px; 
    word-wrap: break-word; 
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


$user_id = $_SESSION['user_id'];

$notifications = $db -> prepare('SELECT message ,pdp ,post_id,
TIMESTAMPDIFF(SECOND, notifications.created_at, NOW()) AS seconds_ago,
                    CASE
                        WHEN TIMESTAMPDIFF(SECOND, notifications.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(SECOND, notifications.created_at, NOW()), \'s ago\')
                        WHEN TIMESTAMPDIFF(MINUTE, notifications.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, notifications.created_at, NOW()), \'m ago\')
                        WHEN TIMESTAMPDIFF(HOUR, notifications.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, notifications.created_at, NOW()), \'h ago\')
                        ELSE CONCAT(TIMESTAMPDIFF(DAY, notifications.created_at, NOW()), \'d ago\')
                    END AS time_ago


FROM notifications
 INNER join users on notifications.user_id = users.id
 WHERE owner_id = :user_id and user_id != :user_id  
  ORDER BY 
 notifications.created_at DESC');


$notifications -> execute(array('user_id'=> $user_id));
    while($data = $notifications -> fetch()) {

        echo "<div class='notification' onclick=\"window.location.href='postview.php?id={$data['post_id']}'\">";
        echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
        echo "<div>";
        echo "<span class='message'>". $data['message'] . "</span>";
        echo "<span>". $data['time_ago'] . "</span>";
        
        echo "</div>";
        echo "</div>";
    }
?>
    
</body>
</html>