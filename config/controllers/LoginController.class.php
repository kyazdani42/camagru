<?php

class LoginController extends Controller {

    public function SignIn() {
        $user = new UserModel();
        try {
            if ($test = $user::connect(htmlspecialchars($_POST['login']), $_POST['password'])) {
                $check = new SessionController();
                $check->setLogin(htmlspecialchars($_POST['login']));
                $this->display('logHome', 'Home');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->display();
        }
    }

    public function SignUp() {
        $user = new UserModel();
        try {
            $user->register(array("login" => htmlspecialchars($_POST['login']), 'password' => $_POST['password'], 'email' => htmlspecialchars($_POST['email'])));
            //add email getter and send mail confirmation
            $this->display('notLogHome', 'home');
            echo "<script>alert('Please validate your email');</script>";
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->register();
        }
    }

    public function register() {
        $this->display('Register', 'Sign Up');
    }

    public function display($place = null, $title = null) {
        parent::__construct();
        if ($place && $title)
            $this->_view->render($place, $title);
        else {
            $this->_view->render('Login', 'Sign In');
        }
    }

    public function error() {
    }

}