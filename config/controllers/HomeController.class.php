<?php

class HomeController extends Controller {

    public function display() {
        parent::__construct();
        require_once "SessionController.class.php";
        $session = new SessionController();
        if ($session->getLogin() === "") {
            $this->_view->render('notLogHome', 'Home');
        } else {
            $this->_view->render('logHome', 'Home');
        }
    }

    public function error() {
    }
}