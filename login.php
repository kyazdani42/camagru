<html>
<head>
    <meta charset="utf-8" />
    <title>Create account</title>
</head>
<body>
<div>
    <h1>Create account</h1>
    <form action="../script.php" method="post">
        <label for="id">Login</label>
        <input type="text" name="id" value=""/><br/>
        <label for="email">Email</label>
        <input type="email" name="email" value=""/><br/>
        <label for="passwd">Password</label>
        <input type="password" name="passwd" value=""/><br/>
        <input type="submit" name="submit" value="OK"/>
    </form>
    <a href="login.php">Login...</a><br/>
    <a href="..">Back to main page...</a><br/>
</div>
</body>
</html>