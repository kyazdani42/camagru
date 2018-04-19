<?php

class CameraController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('camera', 'Take a pic');
    }

    public function sendPicture() {
        $data = $_POST['myData'];
        $login = SessionController::getLogin();
        $image = new ContentModel;
        $image->setPhoto($data, $login);
        header("location: " . URL . "Camera");
    }

    public function error() {}
}