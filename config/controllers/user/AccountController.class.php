<?php

class AccountController extends Controller {

    public function display () {
        parent::__construct();
        $this->_view->render('account', 'Parameters');
    }

    public function modLog() {
        if (isset($_POST) && isset($_POST['newLogin']) && !empty($_POST['newLogin'])) {
            $db = new UserModel();
            $log = $_POST['newLogin'];
            try {
                $db->modLogin($log);
                SessionController::setLogin($log);
            } catch (Exception $e) {
                SessionController::setSession('error', $e->getMessage());
                header('location: '. URL . 'Account');
            }
        }
        header('location: ' . URL . 'Account');
    }

    public function modPass() {
        if (isset($_POST) && isset($_POST['newPass']) && !empty($_POST['newPass'])) {
            $db = new UserModel();
            try {
                $db->modPassword($_POST['newPass']);
            } catch (Exception $e) {
                SessionController::setSession('error', $e->getMessage());
                header('location: '. URL . 'Account');
            }
        }
        header('location: ' . URL . 'Account');
    }

    public function modEmail() {
        if (isset($_POST) && isset($_POST['newEmail']) && !empty($_POST['newEmail'])) {
            $db = new UserModel();
            try {
                $db->modEmail($_POST['newEmail']);
            } catch (Exception $e) {
                SessionController::setSession('error', $e->getMessage());
                header('location: '. URL . 'Account');
            }
        }
        header('location: ' . URL . 'Account');
    }

    /*
     * Must delete also all photos, comments and likes associated with the account !
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
