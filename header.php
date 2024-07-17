<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: sans-serif;
        }
        body {
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            position: relative;
        }
        header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            background-color: #FFF;
            height: 50px;
            box-shadow: 0px 5px 5px -5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        a {
            text-decoration: none;
            color: black;
            height: 50px;
            padding: 0 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        a:hover {
            background-color: #f0f2f5;

        }

        .notificationContainer {
            height: 40px;
            width: 40px;
            border-radius: 100px;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;

        }
        .notificationContainer:hover {
            background-color: #D8DADF;

        }

        .notificationContainer img {
            width: 21px;
            height: 19px;
        }

        .notific {
        display: none;
       height: 50vh;
        position: fixed;
    top: 30%;
    left: 65%;
    transform: translate(-50%, -50%);
    background-color: white;
    width: 360px;
    padding: 20px;
    border-radius: 8px;
        max-height: calc(100vh - 190px);
        overflow-y: scroll;
        
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    z-index: 1001;
    overflow-x: hidden;
    white-space: nowrap;


    }
    
    .close {
        width: 100%;
        margin-bottom: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .close img {
        height: 23px;
        width: 23px;
        cursor: pointer;
       float: right;
    }
    .notifnum {
        background-color: red;
        color:#fff;
        padding: 4px 6px;
        border-radius: 100px;
        position: absolute;
        top: -4%;
        font-size: 11px;
        right: -15%;
    }

    .clearDiv {
        width: 100%;
        margin-bottom:10px;
        height: 20px;
       
       
    }

    .clearDiv span {
       color: red;
      text-decoration: underline;
      font-size: 14px;
      cursor: pointer;
    }
    @media (max-width: 615px) {

.notific {
left: 50%;
}
  }


        </style>
</head>
<body>


<?php
require("connection.php");
if(isset($_COOKIE['user'])) {
   

$user_id = $_COOKIE['user_id'];
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