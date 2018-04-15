<?php

require_once("database.php");
session_start();
if (!isset($_SESSION['log_user']))
    $_SESSION['log_user'] = "";

?>
