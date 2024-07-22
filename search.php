<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialDZ</title>
    <link rel="stylesheet" href="styles/search.css">
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