<?php

class HomeController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('Home', 'Home');
    }

    public function error() {
    }
}