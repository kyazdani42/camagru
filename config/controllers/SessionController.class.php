<?php

class SessionController extends Controller {

    public static function setLogin( $login ) {
        $_SESSION['log_user'] = $login;
    }

    public static function getLogin() {
        return ($_SESSION['log_user']);
    }

    public static function logout() {
        $_SESSION['log_user'] = "";
    }

    public static function setSession( $type, $error ) {
        $_SESSION[$type] = $error;
    }

}