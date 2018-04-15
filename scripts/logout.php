<?php

session_start();
$_SESSION['log_user'] = "";
header('location: ../index.php');

?>