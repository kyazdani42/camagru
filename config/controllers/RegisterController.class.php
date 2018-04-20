<?php

class RegisterController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('register', 'Sign Up', 1);
    }

    public function SignUp()
    {
        $user = new UserModel();
        parent::__construct();
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
        parent::__construct();
        try {
            $user->verifyAccount($hash);
            SessionController::setSession("valid", "Your account has been verified");
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
        $message = '
 
Thanks for signing up!
Your account has been created, you can login after you have activated your account by pressing the url below.
 
Please click this link to activate your account:
http://192.168.99.100:8080/Login/verify/'. $array['hash'] . '
 
';

        $headers = 'From:noreply@camagru.io' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

}