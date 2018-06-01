<div class="main">
    <?php if ($ret === 1) { foreach ($array as $e => $key) { ?>
        <div class="container">
            <div class="containerPhoto">
                <img class="photos" src="data:image/jpeg;base64,<?= base64_encode(file_get_contents($key['data'])); ?>">
            </div>
            <div class="likeBox">
                <span class="countLike"><?php echo $key['likes']; if ($key['likes'] <= 1) echo " Like"; else echo " Likes"; ?></span>
                <div class="userPic">Posted by <?= $key['login'] ?></div>
            </div>
            <div class="openComs">
                <span>click here for more</span>
            </div>
        </div>
        <div class="hiddenContainer">
            <div class="box">
                <div class="container">
                    <div class="containerPhoto">
                        <img class="photos" src="data:image/jpeg;base64,<?= base64_encode(file_get_contents($key['data'])); ?>">
                    </div>
                    <div class="likeBox">
                        <div class="userPic">Posted by <?= $key['login'] ?></div>
                    </div>
                    <div class="containerAttributes">
                        <div class="containerComments">
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
                                            <?= htmlspecialchars($e['com']) ?>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } } ?>
</div>
<script src="public/js/modal.js"></script>
