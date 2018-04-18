<?php

class HomeController extends Controller {

    public function __construct() {

            parent::__construct();
            require_once "SessionController.class.php";
            $session = new SessionController();
            if ($session->getLogin() === "") {
                $this->_view->render('baseHome', 'Home', 1);
            } else {
                $this->_view->render('logHome', 'Home');
            }
    }

    public function error() {
    }
}