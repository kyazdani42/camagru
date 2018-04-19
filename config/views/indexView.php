<?php foreach ($photos as $e => $key) { ?>
    <div>
        <img class="photos" src="data:image/jpeg;base64,<?= $key['data'] ?>">
    </div>
<?php } ?>