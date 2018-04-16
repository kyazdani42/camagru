<?php
session_start();
require_once('../config/database.php');
if ($_POST && isset($_POST['login']) && isset($_POST['passwd'])) {

    $password = hash('whirlpool', $_POST['passwd']);
    $login = htmlspecialchars($_POST['login']);

    if (($query = $data->query("SELECT password FROM `user` WHERE login = '" . $login . "'"))->rowCount() !== 0) {
        if ($query->fetch()["password"] === $password) {
            $_SESSION['log_user'] = $login;
            header('location: ../loggued.php');
        } else {
            $_SESSION['error_log'] = 'wrong password';
            header('location: ../index.php');
        }
    } else {
        $_SESSION['error_log'] = 'wrong login';
        header('location: ../index.php');
    }
}
else {
    header('location: ../index.php');
}


?>