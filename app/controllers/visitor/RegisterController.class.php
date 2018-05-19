<?php

class RegisterController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('register', 'Sign Up', 1);
    }

    public function SignUp() {

		if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['password'])) {
			SessionController::setSession('error', "Incorrect informations");
			header('location:' . URL . "Register");
			die ();
		} else if ($this->_checkInput(array('ascii' => $_POST['login']))) {
		    SessionController::setSession("error", "Login must contain only alphabetical characters and numbers");
            header('location:' . URL . "Register");
		    die();
        } else if ($this->_checkInput(array('mail' => $_POST['email']))) {
		    SessionController::setSession("error", "incorrect mail");
            header('location:' . URL . "Register");
		    die();
        } else if (strlen($_POST['login']) > 14) {
		    SessionController::setSession("error", "login is too long (14 characters max)");
		    header('location:' . URL . "Register");
		    die();
		}
        $user = new RegisterModel();
        try {
            $array = $user->register(array("login" => $_POST['login'], 'password' => $_POST['password'], 'email' => $_POST['email']));
            $this->_send_mail($array);
            SessionController::setSession("valid", 'A confirmation mail has been sent to your mailbox, please validate before log in');
            header('location:' . URL . 'Home');
        } catch (Exception $e) {
            SessionController::setSession("error", $e->getMessage());
            header('location:' . URL . "Register");
        }

    }

    public function verify($hash = null) {
        $user = new RegisterModel();
		if ($hash === null) {
			header('location:' . URL . 'Home');
			die();
		}
        try {
            $user->verifyAccount($hash);
            SessionController::setSession("valid", "Your account has been verified, you can now log in");
            header('location:' . URL . 'Home');
        } catch (Exception $e) {
            SessionController::setSession("error", $e->getMessage());
            header('location:' . URL . "Home");
        }
    }

    private function _send_mail($array)
    {
        $to = $array['email'];
        $subject = 'Signup | Verification';
        $message = 'Thanks for signing up! You can login after you have activated your account by following this link: ' . URL . 'Register/verify/'. $array['hash'];
        mail($to, $subject, $message);
    }

}
