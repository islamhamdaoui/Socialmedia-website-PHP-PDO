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
        </style>
</head>
<body>
    <header>
        <a  href="home.php">Home</a>
        <?php if(empty($_SESSION['user'])): ?>
            <a  href="index.php">Login</a>
            <a href="signupform.php">Signup</a>
            <?php  else: ?>
                <a  href="profile.php">Profile</a>
                <a  href="search.php">Search</a>
                <a href="logout.php">Logout</a>
        <?php  endif; ?>
        
    </header>

 
</body>
</html>