<div><h3>Hello <?= $session->getLogin(); ?></h3></div>

<?php foreach ($photos as $e => $key) { ?>
    <div class="containerPhoto">
        <img class="photos" src="data:image/jpeg;base64,<?= $key['data'] ?>">
    </div>
<?php } ?>
