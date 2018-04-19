<video id="video"></video>
<button id="startbutton">Prendre une photo</button>
<canvas id="canvas" style="display:none"></canvas>
<div class="output">
    <img id="photo" />
</div>
<form action="<?= URL ?>Camera/sendPicture" method="POST" id="cameraForm">
    <input type="submit" name="myData" id="myData" value="">
</form>
    <script language="javascript">

        document.getElementById("myData").addEventListener("click", function () {
            const data = document.getElementById("photo").getAttribute("src").split("base64,")[1];
            document.getElementById("myData").setAttribute("value", data);

        });

    </script>


<script src="/public/js/webcam.js"></script>