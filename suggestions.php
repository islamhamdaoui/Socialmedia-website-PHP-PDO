<?php

 require("connection.php");
 $user_id = $_COOKIE['user_id'];
 //shows 5 random suggestions everytime u refrech
 $suggestions = $db ->prepare("SELECT * FROM users WHERE  id != :user_id ORDER BY RAND() LIMIT 5");
 $suggestions->execute(array(
   'user_id' =>$user_id

));

 while($row = $suggestions->fetch()){
    echo "<div class='result' onclick=\"window.location.href='info.php?id={$row['id']}'\">";
    echo "<img src='uploads/{$row['pdp']}.png' alt='{$row['pdp']} Image'>";
   echo"  <div class='userinfo'> ";
    echo "<b >" . $row['username'] . "</b> <br>";
    echo "<span>" . $row['email'] . "</span>";
    echo "</div>";
    echo '<div class="btn">';
    echo '<p>Profile</p>';

    
    echo "</div>";
    echo "</div>";
 }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         .results {
            margin-top: 50px;
        }
        .result {
            display: flex;
            align-items: center;
            width: 300px;
            padding: 10px;
            margin-bottom: 10px;
            /* background-color: #fff; */
            border-radius: 8px;
            /* box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1); */
            cursor: pointer;
        }

        .result:hover {
            background-color: #E4E6E9;
        }

        .result img {
            width: 38px;
            margin-right: 7px;
            height: 38px;
           
        }
        .btn {
    width: 100%;
    display: flex;
    justify-content: flex-end;
}




  .result .userinfo span {
    font-size: 12px;
  }
  .result .userinfo b {
    font-size: 14px;
  }
  .result .btn p {
    font-size: 12px;
    color: #0866ff;
  }
  .result .btn p:hover {
    text-decoration: underline;
  }
  


    </style>
 </head>
 <body>
    
 </body>
 </html>