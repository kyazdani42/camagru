<div class="main">
<?php if ($ret === 1) { foreach ($array as $e => $key) { ?>
    <div class="container">
        <div class="containerPhoto">
            <img class="photos" src="data:image/png;base64,<?= base64_encode(file_get_contents($key['data'])); ?>">
        </div>
        <div class="containerAttributes">
            <div class="likeBox">
                <div id="like<?= $key['id_photo'] ?>" class='Boxheart'>
                    <div class=<?php if ($key['flag'] === 1) { ?>"clickHeart"> <?php } else { ?>"heart"> <?php } ?></div>
                </div>
                <span class="countLike"><?= $key['likes'] ?> Likes</span>
            </div>
            <div class="containerComments">
				<form action="<?= URL ?>Home/sendComment/<?= $key['id_photo'] ?>" class="formSend" id="form<?= $key['id_photo']?>" method="post">
					<textarea name="comment" placeholder="Write a comment" maxlength="255"></textarea>
					<input type="submit" value="send">
                </form>
                <div class="comBox">
                    <?php if ($key['comments'] !== null) { foreach ($key['comments'] as $e) { ?>
                    <div class="comRow">
                        <div class="commentTime">
                        <?php
                        $date1 = strtotime(date("Y-m-d H:i:s"));
                        $date2 = strtotime($e['date']);
                        $secs = $date1 - $date2;
                        if ($secs < 60)
                            echo $secs . " seconds ago";
                        else if ($secs < 3600)
                            echo floor($secs / 60) . " minutes ago";
                        else if ($secs < 86400)
                            echo floor($secs / 3600) . " hours ago";
                        else
                            echo floor($secs / 86400) . " days ago";
                        ?>
                        </div>
                        <div class="commentLogin">
                            <?= "By " . $e['login'] ?>
                        </div>
                        <div class="commentContent">
                        <?= $e['com'] ?>
                        <?php if ($e['check'] === 1): ?>
                            <a id="com<?= $e['id']?>" href="<?= URL . "Home/delComment/" . $e['id'] ?>"><img src="public/images/crossbox.png" style="width:15px"></a>
                        <?php endif; ?>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>
</div>
<script src="public/js/homeBox.js"></script>
