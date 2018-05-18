<div class="contentAccount">

    <form class="modifySettings" action="<?= URL ?>Account/modLog" method="post">
        <input type="text" name="newLogin" value="">
        <input type="submit" value="Change your login">
    </form>

    <form class="modifySettings" action="<?= URL ?>Account/modPass" method="post">
        <input type="password" name="newPass" value="">
        <input type="submit" value="Change your password">
    </form>

    <form class="modifySettings" action="<?= URL ?>Account/modEmail" method="post">
        <input type="email" name="newEmail" value="">
        <input type="submit" value="Change your email">
    </form>

    <a class="mailChecker" id="mailChecker" href="<?= URL ?>Account/setMailCheck"><?php if ($array['check'] === '0') { ?>enable<?php } else { ?>disable<?php } ?> mail when someone comments one of your pictures</a>
    <a class="delAccount" href="<?= URL ?>Account/delete">Delete your account</a>
</div>

<script src="public/js/accountMailCheck.js"></script>