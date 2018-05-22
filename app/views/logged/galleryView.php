<div class="gallery">
    <?php if ($array !== null): ?>
    <div class="main">
        <?php foreach($array as $e => $key) { ?>
        <div class="container">
            <img src="data:image/png;base64,<?= base64_encode(file_get_contents($key['data'])) ?>">
            <a class="deleteLink" href="<?= URL ?>Gallery/delete/<?= $key['id'] ?>">Delete this photo</a>
        </div>
        <?php } ?>
    </div>
    <?php endif ?>
</div>