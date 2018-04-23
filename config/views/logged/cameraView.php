<div class="main">
    <div class="pictures">
        <video id="video"></video>
        <canvas id="canvas" style="display:none"></canvas>
        <div class="output">
            <img src="">
            <img id="photo" src="<?php if (!empty($_SESSION['imgContent'])) { echo "data:image/jpeg;base64," . $_SESSION['imgContent']; unset($_SESSION['imgContent']); } ?>" />
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
            <input type="submit" name="myData" id="myData" value="send">
        </form>
    </div>
    <div class="list">
        <li>
            <ul><img src="" /></ul>
            <ul><img src="" /></ul>
            <ul><img src="" /></ul>
            <ul><img src="" /></ul>
            <ul><img src="" /></ul>
            <ul><img src="" /></ul>
            <ul><img src="" /></ul>
        </li>
    </div>
</div>
<div class="rightNav">
<!-- MIGHT BE A A FOREACH HERE OR AJAX HANDLER FOR CURRENT PHOTO LIST -->
</div>

<script src="/public/js/webcam.js"></script>