
<div>
    <h1>Login</h1>
    <form action="<?= URL ?>Login/signIn" method="POST">
        <input type="text" name="login" placeholder="login" value=""/><br/>
        <input type="password" name="password" placeholder="password" value=""/><br/>
        <input type="submit" name="submit" />
    </form>
    <a href="<?= URL ?>Home">Back to Home page</a>
</div>