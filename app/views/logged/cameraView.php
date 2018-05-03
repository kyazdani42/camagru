<div class="mainCam">
    <div class="pictures">
        <video id="video"></video>
        <canvas id="canvas" style="display:none"></canvas>
        <div class="output">
            <img id=staticPhoto>
            <img id="photo" src="<?php if (!empty($_SESSION['imgContent'])) { echo "data:image/png;base64," . $_SESSION['imgContent']; unset($_SESSION['imgContent']); } ?>">
        </div>
        <button id="startbutton">Prendre une photo</button>
    </div>
    <div class="forms">
        <form action="<?= URL ?>Camera/handleFile" enctype="multipart/form-data" id="form" method="POST">
            <input type="file" name="myData" id="file" accept="image/jpeg;image/png;image/jpg;image/gif" value="send">
            <input type="hidden" name="MAX_FILE_SIZE" value="65535" />
            <input type="submit" value="upload">
        </form>
        <form action="<?= URL ?>Camera/sendPicture" method="POST" id="cameraForm">
            <input type="text" name="staticData" id="staticData" style="display:none">
            <input type="submit" name="myData" id="myData" value="send">
        </form>
    </div>
    <div class="list">
        <li>
            <ul class="staticImg"><img src="public/images/cartman.png" /></ul>
            <ul class="staticImg"><img src="public/images/Kenny.png" /></ul>
            <ul class="staticImg"><img src="public/images/kyle.png" /></ul>
            <ul class="staticImg"><img src="public/images/Butters.png" /></ul>
            <ul class="staticImg"><img src="public/images/stan.png" /></ul>
            <ul class="staticImg"><img src="public/images/Timmy.png" /></ul>
        </li>
    </div>
</div>
<div class="rightNav">
    <?php if ($array !== null) {
        foreach($array as $e) { ?>
            <div class="navBox">
                <img src="data:image/png;base64,<?= base64_encode(file_get_contents($e)) ?>"/>
            </div>
        <?php } ?>
    <?php } ?>
</div>
<script src="public/js/webcam.js"></script>
<script src="public/js/image.js"></script>