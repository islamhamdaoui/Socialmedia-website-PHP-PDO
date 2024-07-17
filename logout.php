<?php
session_start();
session_unset();
session_destroy();
setcookie('user', '', time() - 3600, '/');
setcookie('user_id', '', time() - 3600, '/');
setcookie('username', '', time() - 3600, '/');
header("location:index.php");
die;