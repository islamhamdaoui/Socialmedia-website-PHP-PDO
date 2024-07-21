<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
     *{
        box-sizing: border-box;
     }
      
        .searchContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 60px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .results {
            margin-top: 50px;
         
            width: 100%;
            max-width: 400px;
        }
        .result {
            display: flex;
            
            width: 100%;
            max-width: 400px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .result img {
            width: 38px;
            margin-right: 7px;
            height: 38px;
           
        }

       

        form {
            margin-top: 20px;
            display: flex;
            width: 100%;
            max-width: 400px;
        }
        
        input[type=text]{
            width: 100%;
            max-width: 310px;
            height: 40px;
            border: none;
            outline: none;
            border-radius: 8px 0 0 8px;
            padding-left: 10px ;
            font-weight: bold;
        }

        input[type=submit] {
            width: 90px;
           border: none;
           font-weight: bold;
           color: #fff;
           background-color: #0866ff;
           border-radius: 0 8px 8px 0;
           cursor: pointer;
        }


 </style>
</head>
<body>
    

<?php 
require('auth.php');
require("header.php");


?>

<div class="searchContainer">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="text" name="search" placeholder="Search..." required>
    <input type="submit" value="Search">
</form>



 <div class="results">
 <?php
 
require("connection.php");
if(isset($_POST["search"])) {
$search = $_POST['search'];
//shows users that u searched about
$result = $db ->prepare("SELECT * FROM users WHERE username LIKE :search");
$result -> execute(array(':search' => '%' . $search . '%'));

if($result->rowCount() > 0) {
while ($data = $result -> fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='result' onclick=\"";
    if ($data['username'] === $_COOKIE['username']) {
        echo "window.location.href = 'profile.php';";
    } else {
        echo "window.location.href = 'profileview.php?id={$data['id']}';";
    }
    echo "\">";
    echo "<img src='uploads/{$data['pdp']}.png' alt='{$data['pdp']} Image'>";
   echo"  <div class='userinfo'> ";
    echo "<b >" . $data['username'] . "</b> <br>";
    echo $data['email'];

    echo "</div>";
    echo "</div>";
}
} else {
 echo 'No results';
}
}
?>



 </div>
 </div>


</body>
</html>