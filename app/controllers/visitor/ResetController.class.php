<?php

class ResetController extends Controller
{

    public function display() {
        parent::__construct();
        $this->_view->render("reset", "Reset your password", 1);
    }

    public function send() {

        if (isset($_POST['email']) && !empty($_POST['email'])) {

            $model = new UserModel();
            if (($hash = $model->setHash($_POST['email'])) === null) {
                SessionController::setSession("error", "please validate your email");
                header('location: ' . URL . 'Home');
                die();
            }
            $msg = "click this link if you want to reset your password: " . URL . "Set/checkPass/" . $hash;
            $mail = $_POST['email'];
            $subject = "Camagru - Reset password";
            mail($mail, $subject, $msg);
            SessionController::setSession("valid", "A mail has been sent to your box");
            header('location: ' . URL . "Home");
            die();
        }
        header('location: ' . URL . "Reset");
    }

}