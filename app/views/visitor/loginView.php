<body>
<div class="loginMain">
    <div class="LoginTitle">
        <h1>Sign in to Camagru !</h1>
    </div>
    <div class="loginBox">
        <form action="<?= URL ?>Login/signIn" method="POST">
            <label for="loginName">Username</label>
            <input id="loginName" type="text" name="login"/><br/>
            <label for="loginPass">password</label>
            <input id="loginPass" type="password" name="password"/><br/>
            <input type="submit" name="submit" value="Sign in" />
        </form>
    </div>
    <div class="loginHome">
        <span>New to camagru ? <a href="<?= URL ?>Register">Create an account.</a></span>
        <a href="<?= URL ?>Home">Back to Home page</a>
    </div>
</div>
</body>
