<?php if ($ret === 1) { foreach ($array as $e => $key) { ?>
    <div class="container">
        <div class="containerPhoto">
            <img class="photos" src="data:image/jpeg;base64,<?= $key['data'] ?>">
        </div>
        <div class="containerAttributes">
            <div class="containerComments">
                <div class="comBox">
                    <?php if ($key['comments'] !== null) { foreach ($key['comments'] as $e) { ?>
                        <span>
                        <?= $e ?>
                    </span>
                    <?php } } ?>
                </div>
            </div>
            <div class="likeBox">
                <span class="countLike"><?= $key['likes'] ?> Likes</span>
            </div>
        </div>
    </div>
<?php } } ?>