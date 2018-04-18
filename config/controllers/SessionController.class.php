<?php

class SessionController extends Controller {

    private static $_logged;

    public function __construct() {

        if (self::$_logged == null) {
            session_start();
            if (isset($_SESSION['log_user'])) {
                self::$_logged = $_SESSION['log_user'];
            } else {
                self::$_logged = "";
            }
        }
    }

    public function setLogin( $login ) {
        session_start();
        $_SESSION['log_user'] = htmlspecialchars($login);
        self::$_logged = $_SESSION['log_user'];
    }

    public function getLogin() {
        return (self::$_logged);
    }

    public static function logout() {
        session_start();
        unset($_SESSION['log_user']);
    }

    public function error() {

    }

}