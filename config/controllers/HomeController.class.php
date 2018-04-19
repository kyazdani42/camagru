<?php

class HomeController extends Controller {

    public function __construct() {

            parent::__construct();
            if (SessionController::getLogin() === "") {
                $this->_view->render('index', 'Home');
            } else {
                $this->_view->render('logged', 'Home');
            }
    }

    public function error() {
    }
}