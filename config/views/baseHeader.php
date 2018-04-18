<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Camagru - <?= $title ?></title>
    <link rel="stylesheet" href="/public/style/style.css">
    <link rel="stylesheet" href="/public/style/footer.css">
    <link rel="stylesheet" href="/public/style/main.css">
    <link rel="stylesheet" href="/public/style/side.css">
    <link rel="stylesheet" href="/public/style/header.css">
</head>
<body>
<header>
    <div class="top-navbar">
        <nav class="navbar">
            <a href="<?= URL ?>Home">Home</a>
            <a id="signIn">Sign in</a>
            <a id="signUp">Sign up</a>
        </nav>
    </div>
</header>
<div id="modalIn" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h1>Login</h1>
        <form action="<?= URL ?>Login/signIn" method="POST">
            <input type="text" name="login" placeholder="login" value=""/><br/>
            <input type="password" name="password" placeholder="password" value=""/><br/>
            <input type="submit" name="submit" />
        </form>
    </div>

</div>
<div id="modalUp" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h1>Register</h1>
        <form action="<?= URL ?>Login/SignUp" method="POST">
            <input type="text" name="login" placeholder="login" value=""/><br/>
            <input type="password" name="password" placeholder="password" value=""/><br/>
            <input type="email" name="email" placeholder="email" value=""/><br/>
            <input type="submit" name="submit" />
        </form>
    </div>

</div>
<div class="content">
    <div id="intro">
        <h1> Welcome to Camagru !</h1>
    </div>
</div>