<video id="video"></video>
<button id="startbutton">Prendre une photo</button>
<canvas id="canvas" style="display:none"></canvas>
<div class="output">
    <img id="photo" />
</div>
<!--<div class="rightNav">-->
<!--    <img id="rightImg"-->
<!--</div>-->
<form enctype="multipart/form-data" id="form" method="POST">
    <input type="file" name="myData" id="file" accept="image/jpeg;image/png;image/jpg;image/gif" value="send">
    <input type="hidden" name="MAX_FILE_SIZE" value="65535" />
    <input type="submit" value="upload">
</form>

<form action="<?= URL ?>Camera/sendPicture" method="POST" id="cameraForm">
    <input type="submit" name="myData" id="myData" value="send">
</form>

<script src="/public/js/webcam.js"></script>
<!--<script>-->
<!---->
<!--    let form = document.querySelector("#form");-->
<!--    form.addEventListener('submit', function () {-->
<!---->
<!--        let http = new XMLHttpRequest();-->
<!--        let obj = document.getElementById('file');-->
<!--        let file = obj.files[0];-->
<!---->
<!--        http.open("POST", "--><?//= URL ?>//Camera/handleFile", false);
//
//        http.onreadystatechange = function () {
//
//            console.log(http.responseText);
//            if (http.readyState === http.DONE && http.status === 200) {
//
//                let ret = http.responseText;
//                console.log(ret);
//                let img = document.querySelector("#photo");
//                img.setAttribute("src", "data:image/jpeg;base64," + ret);
//            }
//        };
//
//        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//        http.send(file);
//
//    });
//
//</script>