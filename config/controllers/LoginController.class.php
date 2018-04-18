<?php

class LoginController extends Controller {

    public function SignIn() {
        $this->display();
    }

    public function display() {
        parent::__construct();
        $this->_view->render('Login', 'Sign In');
    }

    public function error() {

    }

}