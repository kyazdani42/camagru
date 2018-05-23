<?php

class LoginController extends Controller {

    public function display() {
            parent::__construct();
            $this->_view->render('login', 'Sign In', 1);
    }

    public function signIn() {
		
        $user = new UserModel();
        if (empty($_POST['login']) || empty($_POST['password'])) {
            SessionController::setSession("error", "must fill in all inputs");
            header("location:" . URL . "Login");
            die();
        }
        try {
            $user->connect($_POST['login'], $_POST['password']);
            SessionController::setLogin($_POST['login']);
            header('location: ' . URL . 'Home');
            die();
        } catch (Exception $e) {
            SessionController::setSession("error", $e->getMessage());
            header('location: ' . URL . "Login");
            die();
        }

    }

}
