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

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="text" name="search" required>
    <input type="submit" value="Search">
</form>



 <div class="results">
 <?php
require("connection.php");
if(isset($_POST["search"])) {
$search = $_POST['search'];

$result = $db ->prepare("SELECT * FROM users WHERE username LIKE :search");
$result -> execute(array(':search' => '%' . $search . '%'));

if($result->rowCount() > 0) {
while ($data = $result -> fetch(PDO::FETCH_ASSOC)) {
    echo $data['username'];
}
} else {
 echo 'No results';
}
}
?>








 </div>

 <style>
    
 </style>
</body>
</html>