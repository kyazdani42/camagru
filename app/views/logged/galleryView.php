<div class="gallery">
    <?php if ($array !== null): ?>
    <div class="main">
        <?php foreach($array as $e => $key) { ?>
        <div class="container">
            <a href="<?= URL ?>Gallery/delete/" <?= $key['id_photo'] ?>>
            <img src="data:image/png;base64,<?= base64_encode(file_get_contents($key['data'])) ?>"
            </a>
        </div>
    </div>
    <?php } endif ?>
</div>