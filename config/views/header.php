<body>
<header>
    <div class="top-navbar">
        <nav class="navbar">
            <a href="<?= URL ?>Home">Home</a>
            <?php
                $session = new SessionController();
                if ($session->getLogin() === "") { ?>
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
<div class="content">
    <div id="intro">
        <h1> Welcome to Camagru !</h1>
    </div>
</div>
