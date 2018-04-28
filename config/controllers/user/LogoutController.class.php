<?php

class LogoutController extends Controller {

    public function __construct() {
        SessionController::logout();
        header("Location: " . URL . 'Home');
    }

}