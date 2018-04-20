<?php

class RegisterController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('register', 'Sign Up', 1);
    }

    public function SignUp()
    {
        $user = new UserModel();
        try {
            $array = $user->register(array("login" => htmlspecialchars($_POST['login']), 'password' => $_POST['password'], 'email' => htmlspecialchars($_POST['email'])));
            $this->_send_mail($array);
            SessionController::setSession("valid", 'A confirmation mail has been sent to your mailbox, please validate before log in');
            header('location:' . URL . 'Home');

        } catch (Exception $e) {
            SessionController::setSession("error", $e->getMessage());
            header('location:' . URL . "Register");
        }
    }

    public function verify($hash) {
        $user = new UserModel();
        try {
            $user->verifyAccount($hash);
            SessionController::setSession("valid", "Your account has been verified, you can now log in");
            header('location' . URL . 'Home');
        } catch (Exception $e) {
            SessionController::setSession("error", $e->getMessage());
            header('location:' . URL . "Home");
        }
    }

    private function _send_mail($array)
    {
        $to = $array['email'];
        $subject = 'Signup | Verification';
        $message = 'Thanks for signing up! You can login after you have activated your account by following this link: http://192.168.99.100:8080/Register/verify/'. $array['hash'];
        mail($to, $subject, $message);
    }

}