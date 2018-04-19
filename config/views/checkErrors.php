<?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
    <script language="Javascript">
        alert("<?= $_SESSION['error'] ?>");

//        const obj = document.createElement("div");
//        const doc = document.getElementsByTagName("body")[0];
//        obj.className = "errorPopup";
//        obj.innerHtml = "<span><?//= $_SESSION['error'] ?>//</span>";
//        doc.appendChild(obj);
//        setTimeout(function () {
//            obj.remove();
//        }, 5000);

    </script>
<?php unset($_SESSION['error']); } ?>
