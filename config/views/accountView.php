<div class="contentAccount">

    <form action="<?= URL ?>Account/modLog">
        <input type="text" name="newLogin" value="">
        <input type="submit" value="Change your login">
    </form>

    <form action="<?= URL ?>Account/modPass">
        <input type="text" name="newPass" value="">
        <input type="submit" value="Change your password">
    </form>

    <form action="<?= URL ?>Account/modEmail">
        <input type="text" name="newEmail" value="">
        <input type="submit" value="Change your email">
    </form>

    <a href="<?= URL ?>Account/delete">Delete your account</a>
    <!--<a href="<?= URL ?>Account/describe">Describe yourself</a>-->
    <!--<a href="<?= URL ?>Account/addPic">Add a profile pic</a>-->
</div>



