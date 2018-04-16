<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Camagru - <!--<?= $title ?>--></title>
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
            <a href="template.php">Home</a>
            <a href="">Login</a>
            <a href="">Register</a>
        </nav>
    </div>
</header>
<div class="content">
    <div id="intro">
        <h1> Welcome to Camagru !</h1>
    </div>

    <div id="TESTING_TESTING">
        <h1>Create account</h1>
        <form action="test.php" method="POST">
            <input type="text" name="login" value="" placeholder="login"/><br/>
            <input type="email" name="email" value="" placeholder="email"/><br/>
            <input type="password" name="password" value="" placeholder="password"/><br/>
            <input type="submit" name="submit" value="PROUT"/>
        </form>
    </div>

    <div id="TESTING_TESTING2">
        <h1>Login</h1>
        <form action="test.php" method="POST">
            <input type="text" name="login" value="" placeholder="login"/><br/>
            <input type="password" name="password" value="" placeholder="password"/><br/>
            <input type="submit" name="submit" value="OK"/>
        </form>
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