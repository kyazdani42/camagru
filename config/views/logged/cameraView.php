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
    <div class="list">
        <li>
            <ul class="staticImg"><img src="/public/images/cartman.png" /></ul>
            <ul class="staticImg"><img src="/public/images/Kenny.png" /></ul>
            <ul class="staticImg"><img src="/public/images/kyle.png" /></ul>
            <ul class="staticImg"><img src="/public/images/Butters.png" /></ul>
            <ul class="staticImg"><img src="/public/images/stan.png" /></ul>
            <ul class="staticImg"><img src="/public/images/Timmy.png" /></ul>
        </li>
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
</div>
<div class="rightNav">
<!-- MIGHT BE A A FOREACH HERE OR AJAX HANDLER FOR CURRENT PHOTO LIST -->
</div>

<script src="/public/js/webcam.js"></script>
<script language="javascript">

    let photo = document.querySelector("#staticPhoto");
    let elem = document.getElementsByClassName("staticImg");
    let i;

    for (i = 0; i < elem.length; i++) {
        elem[i].addEventListener("click", function (e) {

            if (e.target.getAttribute("src") !== null) {
                let data = getImg(e.target, "png");

                console.log(data);
                photo.setAttribute("src", data);
            }

        });
    }

    document.getElementById("myData").addEventListener("click", function () {
        let img = document.getElementById("staticPhoto");
        let data2 = getImg(img, "png").replace(/^data:image\/(png|jpg);base64,/, "");
        let data = document.getElementById("photo").getAttribute("src");

        document.getElementById("staticData").setAttribute("value", data2);
        document.getElementById("myData").setAttribute("value", data.replace(/^data:image\/(png|jpg|jpeg|gif);base64,/, ""));
    });

    function getImg(img, check) {
        let canvas = document.createElement("canvas");
        let data2 = "";

        canvas.width = img.width;
        canvas.height = img.height;
        let ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);
        if (check === "png")
            data2 = canvas.toDataURL("image/png");
        else if (check === "jpeg")
            data2 = canvas.toDataURL("image/jpeg");
        else
            data2 = canvas.toDataURL("image/gif");
        return (data2);
    }

</script>