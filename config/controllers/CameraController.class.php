<?php

class CameraController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('camera', 'Take a pic');
    }

    public function sendPicture() {
        if (!$_POST || !isset($_POST['myData']) || $_POST['myData'] === "undefined") {
            header("location: " . URL);
            die();
        }
        $data = $_POST['myData'];
        $login = SessionController::getLogin();
        $image = new ContentModel;
        $image->setPhoto($data, $login);
        header("location: " . URL . "Camera");
    }

}