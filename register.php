<?php
session_start();
if (isset($_SESSION['error_reg'])) {
    echo "<script>alert('". $_SESSION['error_reg'] . "')</script>";
    unset($_SESSION['error_reg']);
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create account</title>
</head>
<body>
    <div>
        <h1>Create account</h1>
        <form action="scripts/create_account.php" method="POST">
            <input type="text" name="login" value="" placeholder="login"/><br/>
            <input type="email" name="email" value="" placeholder="email"/><br/>
            <input type="password" name="passwd" value="" placeholder="password"/><br/>
            <input type="submit" name="submit" value="OK"/>
        </form>
        <a href="index.php">Back to main page...</a><br/>
    </div>
</body>
</html>