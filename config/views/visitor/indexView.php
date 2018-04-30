<div class="main">
<?php if ($ret === 1) { foreach ($array as $e => $key) { ?>
    <div class="container">
        <div class="containerPhoto">
            <img class="photos" src="data:image/jpeg;base64,<?= base64_encode(file_get_contents($key['data'])); ?>">
        </div>
        <div class="likeBox">
            <span class="countLike"><?= $key['likes'] ?> Likes</span>
        </div>
        <div class="containerAttributes">
            <div class="containerComments">
                <div class="comBox">
                    <?php if ($key['comments'] !== null) { foreach ($key['comments'] as $e) { ?>
                    <span>
                        <?= $e['com'] ?>
                    </span>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>
</div>
