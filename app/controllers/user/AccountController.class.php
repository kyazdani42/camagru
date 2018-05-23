<?php

class AccountController extends Controller {

    public function display ($array = null) {
        parent::__construct();
        if ($array === null) {
            $array = $this->_getMailCheck();
        }
        $this->_view->render('account', 'Settings', 0, $array);
    }

    public function modLog() {

        if (isset($_POST) && isset($_POST['newLogin']) && !empty($_POST['newLogin'])) {
            $db = new ModifModel();
            $log = $_POST['newLogin'];
            if (strlen($log) > 15) {
                SessionController::setSession("error", "Login is too long (14 chars max)");
                header("Location: " . URL . "Account");
                die();
            } else if ($this->_checkInput(array("ascii" => $log))) {
                SessionController::setSession("error", "Login must contain only alphabetical characters and numbers");
                header("Location: " . URL . "Account");
                die();
            }
            try {
                $db->modLogin($log);
                SessionController::setLogin($log);
            } catch (Exception $e) {
                SessionController::setSession('error', $e->getMessage());
                header('location: '. URL . 'Account');
            }
        } else {
            SessionController::setSession("error", "Please enter something");
        }
        header('location: ' . URL . 'Account');

    }

    public function modPass() {

        if (isset($_POST) && isset($_POST['newPass']) && !empty($_POST['newPass'])) {
            if (strlen($_POST['newPass']) < 8) {
                SessionController::setSession("error", "Password must contain at least 8 characters");
                header("location: " . URL . "Account");
            }
            $db = new ModifModel();
            try {
                $db->modPassword($_POST['newPass']);
            } catch (Exception $e) {
                SessionController::setSession('error', $e->getMessage());
                header('location: '. URL . 'Account');
            }
        } else {
            SessionController::setSession("error", "Incorrect Parameter");
        }
        header('location: ' . URL . 'Account');

    }

    public function modEmail() {

        if (isset($_POST) && isset($_POST['newEmail']) && !empty($_POST['newEmail'])) {
            if ($this->_checkInput(array("mail" => $_POST['newEmail']))) {
                SessionController::setSession("error", "Incorrect mail");
                header('location:' . URL . "Account");
                die();
            }
            $db = new ModifModel();
            try {
                $db->modEmail($_POST['newEmail']);
            } catch (Exception $e) {
                SessionController::setSession('error', $e->getMessage());
                header('location: '. URL . 'Account');
                die();
            }
        } else {
            SessionController::setSession("error", "Incorrect Parameter");
        }
        header('location: ' . URL . 'Account');

	}

	protected function _getMailCheck() {

        $db = new UserModel();
        $value = $db->getMail();
        return (array('check' => $value));

    }

    public function setMailCheck() {

        $db = new UserModel();
        $val = $db->setMail();
        if ($this->_isAjax()) {
            echo json_encode(array("ok" => $val));
            die();
        }
        header('location: ' . URL . "Account");

    }

	/*
	 * delete one photo and all comments/likes associated with it
	 */

    public function deletePhoto($id) {

		$photo = new PhotoModel();
		$photo->deleteImg($id);

	}

	/*
	 * delete whole account, with all photos, comments, likes associated
	 */

    public function delete() {

        if (SessionController::getLogin() !== null && SessionController::getLogin() !== "") {
            $db = new UserModel();
            $db->deleteAccount();
            SessionController::logout();
        }
        header("location: " . URL . "Home");

    }

}
