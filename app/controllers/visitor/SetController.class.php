<?php

class SetController extends Controller {

   public function display() {
       parent::__construct();
       $this->_view->render("set", "reset your password", 1, array("login" => $_SESSION['resetLog']));
   }

   public function checkPass($hash) {
       $obj = new UserModel();
       if (($login = $obj->checkHash($hash)) !== null) {
           SessionController::setSession("resetLog", $login);
           header('location: ' . URL . 'Set');
       } else {
           header('location: ' . URL . 'Home');
       }
   }

   public function update($login = null) {

       if (empty($_POST['setPass']) || empty($_POST['confPass']) || $login !== $_SESSION['resetLog']) {
           SessionController::setSession("erorr", "unauthorized access to this page, you have been redirected to Home");
           header('location: ' . URL . 'Home');
       } else if ($_POST['setPass'] !== $_POST['confPass']) {
           SessionController::setSession("error", "Passwords must be identical");
           header('location: ' . URL . 'Set');
       } else {
           $model = new ModifModel();
           try {
               $model->resetPass($_POST['setPass'], $login);
               header('location: ' . URL . "Home");
           } catch (Exception $e) {
               SessionController::setSession("error", $e->getMessage());
           }
       }

   }

}
