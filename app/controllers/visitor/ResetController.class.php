<?php

class ResetController extends Controller
{

    public function display() {
        parent::__construct();
        $this->_view->render("reset", "Reset your password", 1);
    }

    public function send() {

        if (isset($_POST['email']) && !empty($_POST['email'])) {

            $hash = md5(rand(0, 1000)) . preg_replace("/@.+/", "", $_POST['email']);
            //SET HASH IN DATABASE >> CHECK IF HASH DOESNT EXIST YET
            $msg = "click this link if you want to reset your password: " . URL . "Reset/changePass/" . $hash;
            $mail = $_POST['email'];

            SessionController::setSession("valid", "A mail has been sent to your box");
            header('location: ' . URL . "Home");
        }
        header('location: ' . URL . "Reset");
    }

    public function changePass($hash = null) {

        if ($hash === null) {
            header('location: ' . URL . "Home");
        }
        $obj = new UserModel();
        if (($login = $obj->checkHash($hash)) !== null) {
            header('location: ' . URL . "Set/setPass/" . $login);
        }
        // check if hash corresponds to an account > if yes send reset form else redirect to home

    }

}