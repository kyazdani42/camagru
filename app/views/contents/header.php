<body>
<header>
    <div class="content">
        <div id="intro">
            <h1><span class="fixedTitle">Welcome to </span>Camagru<span class="fixedTitle"> <?php if (($login = SessionController::getLogin()) !== null && $login !== "") { SessionController::printLogin(); } ?> !</span></h1>
        </div>
    </div>
    <div class="top-navImg">
        <img src="public/images/menu-icon.png" class="menuIcon" id="menuIcon"/>
        <ul class="navImg">
            <li class=".navList"><a href="<?= URL ?>Home"><img src="public/images/home-icon.png" /></a></li>
            <?php
                if (SessionController::getLogin() === "" || SessionController::getLogin() === null) { ?>
                    <li class=".navList"><a href="<?= URL ?>Login"><img src="public/images/login-icon.png" /></a></li>
                    <li class=".navList"><a href="<?= URL ?>Register"><img src="public/images/register-icon.png" /></a></li>
            <?php } else { ?>
                    <li class=".navList"><a href="<?= URL ?>Gallery"><img src="public/images/gallery-icon.png" /></a></li>
                    <li class=".navList"><a href="<?= URL ?>Account"><img src="public/images/settings-icon.png" /></a></li>
                    <li class=".navList"><a href="<?= URL ?>Camera"><img src="public/images/cam-icon.png" /></a></li>
                    <li class=".navList"><a href="<?= URL ?>Logout"><img src="public/images/logout-icon.png" /></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="top-navbar">
        <nav class="navbar">
            <a href="<?= URL ?>Home">Home</a>
            <?php
                if (SessionController::getLogin() === "" || SessionController::getLogin() === null) { ?>
            <a href="<?= URL ?>Login">Sign in</a>
            <a href="<?= URL ?>Register">Sign up</a>
            <?php } else { ?>
            <a href="<?= URL ?>Gallery">Gallery</a>
            <a href="<?= URL ?>Account">Account</a>
            <a href="<?= URL ?>Camera">Camera</a>
            <a href="<?= URL ?>Logout">Logout</a>
            <?php } ?>
        </nav>
    </div>
</header>
