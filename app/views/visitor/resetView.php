<body>
<div class="resetMain">
    <div class="resetTitle">
        <h1>Reset your password</h1>
    </div>
    <div class="resetBox">
        <form action="<?= URL ?>Reset/send" method="POST">
            <label for="resetMail">Enter your mail</label>
            <input id="resetMail" type="email" name="email"/><br/>
            <input id="submitBox" type="submit" name="submit" value="send email" />
        </form>
        <a href="<?= URL ?>Home">Back to Home page</a>
    </div>
</div>
</body>
