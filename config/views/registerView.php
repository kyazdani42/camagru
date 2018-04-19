<div>
    <h1>Register</h1>
    <form action="<?= URL ?>Register/SignUp" method="POST">
        <input type="text" name="login" placeholder="login" value=""/><br/>
        <input type="password" name="password" placeholder="password" value=""/><br/>
        <input type="email" name="email" placeholder="email" value=""/><br/>
        <input type="submit" name="submit" />
    </form>
    <a href="<?= URL ?>Home">Back to Home page</a>
</div>