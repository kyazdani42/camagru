<?php
require_once '../Model/User.class.php';

if ($_POST['submit'] === 'OK') {
    try {
        User::connect($_POST['login'], $_POST['password']);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else if ($_POST['submit'] == 'PROUT') {
    try {
        $new = new User ( array ('login' => $_POST['login'], 'password' => $_POST['password'], 'email' => $_POST['email']));
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else
    echo "wtf";
header('location: template.php');