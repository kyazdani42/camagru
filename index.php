<?php
session_start();
require_once('config/setup.php');

if ($_SESSION['log_user'] !== "")
    header('location: loggued.php');
if (isset($_SESSION['error_log'])) {
    echo "<script>alert('". $_SESSION['error_log'] . "')</script>";
    unset($_SESSION['error_log']);
}
if (isset($_SESSION['error_reg'])) {
    echo "<script>alert('". $_SESSION['error_reg'] . "')</script>";
    unset($_SESSION['error_reg']);
}

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
                    <!--Trigger-->
                    <a id="myBtn">Login</a>
                    <!--modal -->
                    <div id="mod1" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div class="modal-body">
                                <h1>Login</h1>
                                <form action="scripts/login.php" method="POST">
                                    <input type="text" name="login" value="" placeholder="login"/><br/>
                                    <input type="password" name="passwd" value="" placeholder="password"/><br/>
                                    <input type="submit" name="submit" value="OK"/>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal 1 -->
                    <!-- Trigger 2 -->
                    <a id="myBtn2">Register</a>
                    <!-- modal 2 -->
                    <div id="mod2" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div class="modal-body">
                                <h1>Create account</h1>
                                <form action="scripts/create_account.php" method="POST">
                                    <input type="text" name="login" value="" placeholder="login"/><br/>
                                    <input type="email" name="email" value="" placeholder="email"/><br/>
                                    <input type="password" name="passwd" value="" placeholder="password"/><br/>
                                    <input type="submit" name="submit" value="OK"/>
                                </form>
                            </div>
                        </div>
                    </div>
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
        <script src="js/modal.js"></script>
    </body>
</html>