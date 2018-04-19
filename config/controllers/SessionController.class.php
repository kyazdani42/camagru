<?php

class SessionController extends Controller {

    private static $_logged;

    public function __construct() {

        if (self::$_logged == null) {
            if (isset($_SESSION['log_user'])) {
                self::$_logged = $_SESSION['log_user'];
            } else {
                self::$_logged = "";
            }
        }
    }

    public function setLogin( $login ) {
        $_SESSION['log_user'] = htmlspecialchars($login);
        self::$_logged = $_SESSION['log_user'];
    }

    public function getLogin() {
        return (self::$_logged);
    }

    public static function logout() {
        $_SESSION['log_user'] = "";
        self::$_logged = "";
    }

    public function error() {}

}