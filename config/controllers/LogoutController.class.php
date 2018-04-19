<?php

class LogoutController extends Controller {

    public function __construct() {
        $session = new SessionController();
        $session::logout();
        header("Location: " . URL . 'Home');
    }

    public function error () {}
}