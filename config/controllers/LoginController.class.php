<?php

class LoginController extends Controller {

    public function SignIn() {
        $user = new UserModel();
        parent::__construct();
        try {
            $user::connect(htmlspecialchars($_POST['login']), $_POST['password']);
        } catch (Exception $e) {
            $this->_view->render('baseHome', 'Home', 1);
            echo $e->getMessage(); //DELETE AFTER AJAX
            return $e->getMessage();
        }
        require_once "SessionController.class.php";
        $check = new SessionController();
        $check->setLogin(htmlspecialchars($_POST['login']));
        $this->_view->render('logHome', 'Home');
    }

    public function SignUp() {
        $user = new UserModel();
        parent::__construct();
        try {
            $array = $user->register(array("login" => htmlspecialchars($_POST['login']), 'password' => $_POST['password'], 'email' => htmlspecialchars($_POST['email'])));
            $this->_send_mail($array);
            $this->_view->render('baseHome', 'Home', 1);
            echo "A confirmation mail has been sent to your mailbox, please validate before log in"; //DELETE AFTER AJAX
            return ('A confirmation mail has been sent to your mailbox, please validate before log in');
        } catch (Exception $e) {
            $this->_view->render('baseHome', 'Home', 1);
            echo $e->getMessage(); //DELETE AFTER AJAX
            return $e->getMessage();
        }
    }

    public function verify($hash) {
        $user = new UserModel();
        parent::__construct();
        try {
            $user->verifyAccount($hash);
            $this->_view->render('logHome', 'Home');
            return "Your account has been verified";
        } catch (Exception $e) {
            $this->_view->render('baseHome', 'Home', 1);
            echo $e->getMessage(); //DELETE AFTER AJAX
            return $e->getMessage();
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

    public function error() {
    }

}