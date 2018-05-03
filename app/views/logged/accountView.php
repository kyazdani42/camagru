<div class="contentAccount">

    <form action="<?= URL ?>Account/modLog" method="post">
        <input type="text" name="newLogin" value="">
        <input type="submit" value="Change your login">
    </form>

    <form action="<?= URL ?>Account/modPass" method="post">
        <input type="text" name="newPass" value="">
        <input type="submit" value="Change your password">
    </form>

    <form action="<?= URL ?>Account/modEmail" method="post">
        <input type="text" name="newEmail" value="">
        <input type="submit" value="Change your email">
    </form>
    <?php if ($array[0]['check'] === 0): ?>
    <a href="<?= URL ?>Account/setCheckMail">receive mail when someone comments one of your images</a>
    <?php else: ?>
    <a href="<?= URL ?>Account/unsetCheckMail">disable mail when someone comment one of your images</a>
    <?php endif ?>
    <a href="<?= URL ?>Account/delete">Delete your account</a>
    <!--<a href="<?= URL ?>Account/describe">Describe yourself</a>-->
    <!--<a href="<?= URL ?>Account/addPic">Add a profile pic</a>-->
</div>



