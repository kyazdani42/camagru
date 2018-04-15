<?php

session_start();
require_once('../config/database.php');
if ($_POST && isset($_POST['login']) && isset($_POST['email']) && isset($_POST['passwd'])) {

    $password = hash('whirlpool', $_POST['passwd']);
    $login = htmlspecialchars($_POST['login']);
    $email = htmlspecialchars($_POST['email']);

    if ($data->query("SELECT login FROM `user` WHERE login = '". $login . "'")->rowCount() !== 0) {
        $_SESSION['error_reg'] = 'Login already taken';
        header('location: ../register.php');
    } else if ($data->query("SELECT email FROM `user` WHERE email = '". $email . "'")->rowCount() !== 0) {
        $_SESSION['error_reg'] = 'email already taken';
        header('location: ../register.php');
    } else {
        $sql = "INSERT INTO `user` (login, email, password) VALUES ('". $login . "', '" . $email . "', '" . $password . "');";
        $data->beginTransaction();
        $data->exec($sql);
        $data->commit();
        $_SESSION['log_user'] = $login;
        header('location: ../index.php');
    }
} else {
    $_SESSION['error_reg'] = 'Enter something please';
    header('location: ../register.php');
}

?>