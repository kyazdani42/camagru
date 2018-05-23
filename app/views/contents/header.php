<body>
<header>
    <div class="content">
        <div id="intro">
            <h1><span class="fixedTitle">Welcome to </span>Camagru<span class="fixedTitle"> <?php if (($login = SessionController::getLogin()) !== null && $login !== "") { SessionController::printLogin(); } ?> !</span></h1>
        </div>
    </div>
    <div class="top-navImg">
        <img src="public/images/menu-icon.png" class="menuIcon" id="menuIcon"/>
        <nav id="navImg" class="navImg">
            <a class="navList" href="<?= URL ?>Home"><img src="public/images/home-icon.png" /></a>
            <?php if (SessionController::getLogin() === "" || SessionController::getLogin() === null) { ?>
                    <a class="navList" href="<?= URL ?>Login"><img src="public/images/login-icon.png" /></a>
                    <a class="navList" href="<?= URL ?>Register"><img src="public/images/register-icon.png" /></a>
            <?php } else { ?>
                    <a class="navList" href="<?= URL ?>Gallery"><img src="public/images/gallery-icon.png" /></a>
                    <a class="navList" href="<?= URL ?>Account"><img src="public/images/settings-icon.png" /></a>
                    <a class="navList" href="<?= URL ?>Camera"><img src="public/images/cam-icon.png" /></a>
                    <a class="navList" href="<?= URL ?>Logout"><img src="public/images/logout-icon.png" /></a>
            <?php } ?>
        </nav>
    </div>
    <div class="top-navbar">
        <nav class="navbar">
            <a <?php if ($_GET['url'] === "Home") { echo 'class="selected" '; } ?>href="<?= URL ?>Home">Home</a>
            <?php
                if (SessionController::getLogin() === "" || SessionController::getLogin() === null) { ?>
            <a href="<?= URL ?>Login">Sign in</a>
            <a href="<?= URL ?>Register">Sign up</a>
            <?php } else { ?>
            <a <?php if ($_GET['url'] === "Gallery") { echo 'class="selected" '; } ?>href="<?= URL ?>Gallery">Gallery</a>
            <a <?php if ($_GET['url'] === "Account") { echo 'class="selected" '; } ?>href="<?= URL ?>Account">Account</a>
            <a <?php if ($_GET['url'] === "Camera") { echo 'class="selected" '; } ?>href="<?= URL ?>Camera">Camera</a>
            <a href="<?= URL ?>Logout">Logout</a>
            <?php } ?>
        </nav>
    </div>
</header>
