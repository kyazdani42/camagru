<?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
    <script language="javascript">

        let ob = document.createElement("div");
        let span = document.createElement("span");
        let doc = document.getElementsByTagName("body")[0];
        ob.className = "errorPopup";
        span.innerHTML = "<?= $_SESSION['error'] ?>";
        ob.appendChild(span);
        doc.insertBefore(ob, doc.firstElementChild);
        setTimeout(function () {
            ob.remove();
        }, 4000);

    </script>
<?php unset($_SESSION['error']); } ?>
</html>