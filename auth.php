<?php
session_start();

if (!isset($_COOKIE['user'])) {
    header("location: index.php");
    exit;
}
?>
