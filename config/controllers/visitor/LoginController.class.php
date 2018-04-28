<?php

class LoginController extends Controller {

    public function display() {
            parent::__construct();
            $this->_view->render('login', 'Sign In', 1);
    }

    public function SignIn() {
        $user = new UserModel();
        try {
            $user::connect($_POST['login'], $_POST['password']);
            SessionController::setLogin($_POST['login']);
            header('Location: ' . URL . 'Home');
        } catch (Exception $e) {
            SessionController::setSession("error", $e->getMessage());
            header('location: ' . URL . "Login");
        }
    }


}