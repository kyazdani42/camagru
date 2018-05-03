<div class="gallery">
    <div class="accountNav">
        <li>
            <ul><a href="<?= URL ?>Gallery/photos">Photos</a></ul>
            <ul><a href="<?= URL ?>Gallery/comments">Comments</a></ul>
            <ul><a href="<?= URL ?>Gallery/likes">Likes</a></ul>
            <ul><a href="<?= URL ?>Gallery/friends">Friends</a></ul>
        </li>
    </div>
    <?php if ($array !== null): ?>
    <div class="main">
        <?php var_dump($array); ?>
    </div>
    <?php endif ?>
</div>