<?php
session_start();
if (isset($_SESSION['error_log'])) {
    echo "<script>alert('". $_SESSION['error_log'] . "')</script>";
    unset($_SESSION['error_log']);
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
</head>
<body>
    <div>
        <h1>Login</h1>
        <form action="scripts/login.php" method="POST">
            <input type="text" name="login" value="" placeholder="login"/><br/>
            <input type="password" name="passwd" value="" placeholder="password"/><br/>
            <input type="submit" name="submit" value="OK"/>
        </form>
        <a href="index.php">Back to main page...</a><br/>
    </div>
</body>
</html>