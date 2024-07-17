<?php
session_start();  
if(isset($_COOKIE['user'])){
  header('location:home.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 require('header.php');

?>

 <div class="signup">
        <!-- Registration Form -->
<form method="post" action="signup.php">
    <input type="text" name="username" placeholder="Username" onkeydown="preventSpace(event)" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    
    <label for="animal_choice">Choose an animal:</label><br>
        <select id="animal_choice" name="pdp" required>
        <option value="default">Default</option>
            <option value="sara">Sara</option>
            <option value="dalia">Dalia</option>
            <option value="islam">Islam</option>
            <option value="mohamed">Mohamed</option>
        </select><br><br>

    <input type="submit" name="register" value="Register">
    <span style="display: flex; align-items: center; justify-content:center;">
    Have an account? 
    <a style="padding: 0; margin: 0; margin-left: 5px; color:#0866ff;" href="index.php">Log in</a>
</span></form>

</div>



<style>
.signup {
    padding: 100px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}
body {
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }
*{
    box-sizing: border-box;
}



form {
    max-width: 350px;
    width: 100%;
}

input {
    width: 100%;
    max-width: 350px;
    margin-bottom: 20px;
    height: 45px;
    border-radius: 8px;
    border: none;
    padding: 5px 10px;
    background-color: #fff;
    box-shadow: 1px 4px 5px rgba(0, 0, 0, 0.1);
}

input[type=submit] {
    background-color: #0866ff;
    color: #fff;
    font-weight: bold;
    width: 100%;
    margin-bottom: 5px;
    cursor: pointer;

} 
input[type=submit]:hover {
    opacity: 0.7;
}
</style>


<script>
         function preventSpace(event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        }
</script>
</body>
</html>