<?php
session_start();
require_once('config/setup.php');
?>
<!doctype html>
<html>
	<head>
        <meta charset="utf-8">
        <title>Camagru</title>
        <link rel="stylesheet" href="style/style.css">
	</head>
	<body>
		<header>
            <div class="headerBox">
                <li class="headList">
                    <ul>1</ul>
                    <ul>2</ul>
                    <ul>3</ul>
                </li>
                <h1>Camagru</h1>
			    <span class="logBox"><?php if (isset($_SESSION['log_user']) && $_SESSION['log_user'] !== "") { echo "Account"; } else { echo "Connexion"; } ?></span>
            </div>
		</header>
		<div class="main">
			<div class="main_main">
			</div>
			<div class="nav">
			</div>
		</div>
		<footer>
		</footer>
	</body>
</html>
