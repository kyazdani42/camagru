<?php
require_once('config/setup.php');
session_start();
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
                    <?php if ($_SESSION['log_user'] !== "") { ?>
                        <a href="">Account</a>
                        <a href="">Parameters</a>
                        <a href="scripts/logout.php">Logout</a>
                    <?php } else { ?>
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    <?php } ?>
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