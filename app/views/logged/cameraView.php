<noscript>
    <div><p>this page needs javascript to work</p></div>
    <style>
        .mainCam{ display: none; }
        .rightNav{ display: none; }
    </style>
</noscript>
<div class="mainCam">
<div class="camContent">
    <div class="pictures">
        <div class="videoBox" id="videoBox">
            <video id="video"></video>
            <img id="staticVideo">
        </div>
        <canvas style="display:none" id="canvas"></canvas>
        <div class="output">
            <img id="staticPhoto">
            <img id="photo" src="<?php if (!empty($_SESSION['imgContent'])) { echo "data:image/png;base64," . $_SESSION['imgContent']; unset($_SESSION['imgContent']); } ?>">
        </div>
        <div class="forms">
            <form class="imgUploader" action="<?= URL ?>Camera/handleFile" enctype="multipart/form-data" id="form" method="POST">
            <label class="labelSelect" for="file">Select an image</label>
            <input class="selectButton" type="file" name="myData" id="file" accept="image/jpeg;image/png;image/jpg;image/gif" value="send">
            <input type="hidden" name="MAX_FILE_SIZE" value="65535" />
            <input class="sendFileButton" type="submit" value="send file">
        </form>
        <button id="startbutton">Take a pic !</button>
        <form class="uploadForm" action="<?= URL ?>Camera/sendPicture" method="POST" id="cameraForm">
            <input type="hidden" name="staticData" id="staticData">
            <input class="uploadButton" type="submit" name="myData" id="myData" value="upload">
        </form>
        </div>
    </div>
    <div class="listElems">
        <ul class="list">
            <li class="staticImg"><img src="public/images/cartman.png" /></li>
            <li class="staticImg"><img src="public/images/Kenny.png" /></li>
            <li class="staticImg"><img src="public/images/kyle.png" /></li>
            <li class="staticImg"><img src="public/images/Butters.png" /></li>
            <li class="staticImg"><img src="public/images/stan.png" /></li>
            <li class="staticImg"><img src="public/images/Timmy.png" /></li>
        </ul>
    </div>
</div>
<div class="rightNav">
    <?php if ($array !== null) {
        foreach($array as $e) { if ($e !== null): ?>
            <div class="navBox">
                <img src="data:image/png;base64,<?= base64_encode(file_get_contents($e)) ?>"/>
            </div>
        <?php endif; } ?>
    <?php } ?>
</div>
</div>
<script src="public/js/webcam.js"></script>
<script src="public/js/image.js"></script>
