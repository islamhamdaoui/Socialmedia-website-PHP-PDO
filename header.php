<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialDZ</title>
   <link rel="stylesheet" href="styles/header.css">



       
</head>
<body>


<?php
require("connection.php");
if(isset($_COOKIE['user'])) {
   

$user_id = $_COOKIE['user_id'];
//show how many notifications u have in the red dot
$notificNum = $db->prepare('SELECT COUNT(*) as notific_num
FROM notifications
WHERE owner_id = :user_id AND user_id != :user_id AND is_read = "No"');

$notificNum->execute(array('user_id' => $user_id));

$countResult = $notificNum->fetch();
$totalNotifications = $countResult['notific_num'];

} 
?>
    <header>
        <a  href="home.php">Home</a>
        <?php if(empty($_COOKIE['user'])): ?>
            <a  href="index.php">Login</a>
            <a href="signupform.php">Signup</a>
            <?php  else: ?>
                <a  href="profile.php">Profile</a>
                <a  href="search.php">Search</a>
                <div class="notificationContainer" onclick="showNotifications()">
                    <img src="icons/bell.png" alt="">
                    <div class="notifnum"><span><?php echo $totalNotifications ?></span></div>
            </div>
                <a href="logout.php">Logout</a>
        <?php  endif; ?>
        
    </header>

    <div class="notific" id="notifications">
<div class="clearDiv" onclick="window.location.href='delete/clearNotifications.php'"><span>Clear all notifications</span></div>
<div class="close">
<b>Notifications</b><br>
<img onclick="closeNotifications()" src="icons/close.png" alt="close">
</div>

<?php require('notifications.php'); ?>
</div>



<script>
     function closeNotifications() {
        
        let followers =document.getElementById('notifications')
       
        notifications.style.display = 'none'
           }
       
           function showNotifications() {
               let notifications =document.getElementById('notifications')
               
       
        notifications.style.display = 'block'
        
           }
</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadNotifications() {
        $.ajax({
            url: 'notifications.php',
            type: 'GET',
            success: function(data) {
                $('#notifications').html(data);
            }
        });
    }

   
    setInterval(loadNotifications, 2000);
</script> -->
 
</body>
</html>