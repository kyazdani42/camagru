<?php

class LogoutController extends Controller {

    public function __construct() {
        SessionController::logout();
        unset($_SESSION['imageSession']);
        header("Location: " . URL . 'Home');
    }

}