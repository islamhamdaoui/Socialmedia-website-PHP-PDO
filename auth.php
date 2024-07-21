<?php
session_start();

//This code will be required in every page that needs to be authorised in it to use it
if (!isset($_COOKIE['user'])) {
    header("location: index.php");
    exit;
}
?>
