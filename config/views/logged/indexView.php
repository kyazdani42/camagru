<div class="main">
<?php if ($ret === 1) { foreach ($array as $e => $key) { ?>
    <div class="container">
        <div class="containerPhoto">
            <img class="photos" src="data:image/jpeg;base64,<?= base64_encode(file_get_contents($key['data'])); ?>">
        </div>
        <div class="containerAttributes">
            <div class="containerComments">
				<form action="<?= URL ?>Home/sendComment/<?= $key['id_photo'] ?>" class="formSend" id="form<?= $key['id_photo']?>" method="post">
					<textarea name="comment" placeholder="Write a comment" maxlength="255"></textarea>
					<input type="submit" value="send">
                </form>
                <div class="comBox">
                    <?php if ($key['comments'] !== null) { foreach ($key['comments'] as $e) { ?>
                    <span><?= $e ?></span>
                    <?php } } ?>
                </div>
            </div>
            <div class="likeBox">
                <div id="like<?= $key['id_photo'] ?>" class='Boxheart'>
					<div class=<?php if ($key['flag'] === 1) { ?>"clickHeart" <?php } else { ?>"heart" <?php } ?> </div>
                </div>
                <span class="countLike"><?= $key['likes'] ?> Likes</span>
            </div>
        </div>
    </div>
<?php } } ?>
</div>
<script src="/public/js/likeBox.js"></script>
<script src="/public/js/commentBox.js"></script>
