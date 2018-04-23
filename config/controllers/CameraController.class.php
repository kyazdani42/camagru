<?php

class CameraController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('camera', 'Take a pic');
    }

    public function sendPicture() {
        if (!$_POST || !isset($_POST['myData']) || $_POST['myData'] === "undefined") {
            header("location: " . URL);
            die;
        }
        $data = $_POST['myData'];
        $login = SessionController::getLogin();
        $image = new ContentModel;
        $image->setPhoto($data, $login);
        header("location: " . URL . "Camera");
    }

    public function handleFile()
    {
        if (isset($_POST)) {
            try {
                $data = $this->_getFileData();
                SessionController::setSession("imgContent", $data);
            } catch (Exception $e) {
                SessionController::setSession("error", $e->getMessage());
            }
            header('location: ' . URL . "Camera");
        }
    }

    private function _getFileData() {

        if ($_FILES['myData']['error'] > 0) {
            throw new Exception("Upload failed");
        } else if ($_FILES['myData']['size'] > 65535) {
            throw new Exception("File is too big");
        } else {

            $extensions = array('jpeg', 'jpg', 'gif', 'png');
            $ext_upload = strtolower(end(explode('.', $_FILES['myData']['name'])));
            if (!in_array($ext_upload, $extensions)) {
                throw new Exception('Invalid extension');
            } else {
                $data = base64_encode(file_get_contents($_FILES['myData']['tmp_name']));
                return $data;
            }
        }
    }

}