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
    echo "<div class='result' onclick=\"window.location.href='info.php?id={$data['id']}'\">";
    echo "<b >" . $data['username'] . "</b>";
    echo $data['email'];

    echo "</div>";
}
} else {
 echo 'No results';
}
}
?>



 </div>

 <style>
     *{
        box-sizing: border-box;
     }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }

        .results {
            margin-top: 50px;
        }
        .result {
            display: flex;
            flex-direction: column;
            width: 400px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
 </style>
</body>
</html>