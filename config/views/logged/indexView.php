<div><h3>Hello <?= SessionController::getLogin(); ?></h3></div>

<?php if ($ret === 1) { foreach ($array as $e => $key) { ?>
    <div class="container">
        <div class="containerPhoto">
            <img class="photos" src="data:image/jpeg;base64,<?= $key['data'] ?>">
        </div>
        <div class="containerAttributes">
            <div class="containerComments">
                <form action="<?= URL ?>Home/sendComment/<?= $key['id_photo']?>" method="post">
                    <input type="text" name="comment" placeholder="Write a comment">
                    <input type="submit" value="send">
                </form>
                <div class="comBox">
                    <?php if ($key['comments'] !== null) { foreach ($key['comments'] as $e) { ?>
                    <span>
                        <?= $e ?>
                    </span>
                    <?php } } ?>
                </div>
            </div>
            <div class="likeBox">
                <?php if ($key['flag'] === 1) { ?>
                <a href="<?= URL ?>Home/sendLike/<?= $key['id_photo'] ?>"><img src="<?= URL ?>public/images/redLike.png"></a>
                <?php } else { ?>
                <a href="<?= URL ?>Home/sendLike/<?= $key['id_photo'] ?>"><img src="<?= URL ?>public/images/whiteLike.png"></a>
                <?php } ?>
                <span class="countLike"><?= $key['likes'] ?> Likes</span>
            </div>
        </div>
    </div>
<?php } } ?>
