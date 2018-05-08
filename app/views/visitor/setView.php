<body>
<div class="setMain">
    <div class="setBox">
        <form action="<?= URL ?>set/update/<?= $array['login'] ?>" method="POST">
            <label for="setPass">new password</label>
            <input id="setPass" type="password" name="setPass"/>
            <label for="confirmPass">Re-enter your password</label>
            <input id="confirmPass" type="password" name="confPass"/>
            <input id="submitBox" type="submit" name="submit" value="send email" />
        </form>
        <a href="<?= URL ?>Home">Back to Home page</a>
    </div>
</div>
</body>