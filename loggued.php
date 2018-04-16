<?php
require_once('config/setup.php');
session_start();
if ($_SESSION['log_user'] === "")
    header('location: index.php');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/side.css">
    <link rel="stylesheet" href="style/header.css">
</head>
<body>
<header>
    <div class="top-navbar">
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="">Account</a>
            <a href="">Parameters</a>
            <a href="scripts/logout.php">Logout</a>
        </nav>
    </div>
</header>
<div class="content">
    <div id="intro">
        <h1> Welcome to Camagru !</h1>
    </div>
</div>
<footer>
    <div class="footer">
        <div id="author">
            © dchiche 2018
        </div>
    </div>
</footer>
</body>
</html>