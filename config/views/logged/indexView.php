<div class="main">
<?php if ($ret === 1) { foreach ($array as $e => $key) { ?>
    <div class="container">
        <div class="containerPhoto">
            <img class="photos" src="data:image/jpeg;base64,<?= base64_encode(file_get_contents($key['data'])); ?>">
        </div>
        <div class="containerAttributes">
            <div class="containerComments">
                <form action="<?= URL ?>Home/sendComment/<?= $key['id_photo']?>" method="post">
                    <textarea name="comment" placeholder="Write a comment" maxlength="255"></textarea>
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
                <div id="like<?= $key['id_photo'] ?>" class='Boxheart'>
                    <svg class="clickHeart" viewBox="0 0 32 29.6">
                        <path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,9.5,11.9,16,21.2 c6.1-9.3,16-12.1,16-21.2C32,3.8,28.2,0,23.6,0z"/>
                    </svg>
                </div>
                <?php } else { ?>
                <div id="like<?= $key['id_photo'] ?>" class='Boxheart'>
                    <svg class="heart" viewBox="0 0 32 29.6">
                        <path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,9.5,11.9,16,21.2 c6.1-9.3,16-12.1,16-21.2C32,3.8,28.2,0,23.6,0z"/>
                    </svg>
                </div>
                <?php } ?>
                <span class="countLike"><?= $key['likes'] ?> Likes</span>
            </div>
        </div>
    </div>
<?php } } ?>
</div>
<script src="/public/js/likeBox.js"></script>
