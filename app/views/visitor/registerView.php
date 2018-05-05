<body>
<div class="registerMain">
    <div class="LoginTitle">
        <h1>Register</h1>
    </div>
    <div class="registerBox">
        <form action="<?= URL ?>Register/SignUp" method="POST">
            <label for="registerName">Enter your name</label>
            <input id="registerName" type="text" name="login" /><br/>
            <label for="registerPass">Enter your password</label>
            <input id="registerPass" type="password" name="password"/><br/>
            <label for="registerMail">Enter your email</label>
            <input id="registerMail" type="email" name="email"/><br/>
            <input id="submitBox" type="submit" name="submit" />
        </form>
    </div>
    <div class="registerHome">
        <span>Already have an account ? <a href="<?= URL ?>Login">Sign in.</a></span>
        <a href="<?= URL ?>Home">Back to Home page</a>
    </div>
</div>
</body>