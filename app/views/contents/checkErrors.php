<?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
    <script language="javascript">
        errorFun(`<?= $_SESSION['error'] ?>`);
    </script>
    <?php unset($_SESSION['error']);
} else if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) { ?>
    <script language="javascript">
        validFun(`<?= $_SESSION['valid'] ?>`);
    </script>
    <?php unset($_SESSION['valid']); } ?>
</html>