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
        foreach ($_POST as $e) {
            echo base64_encode($e);
        }
        return ;
        if (isset($_POST)) {
            try {
                $data = $this->_getFileData();
                echo $data;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    private function _getFileData() {

        if ($_POST['myData']['error'] > 0) {
            throw new Exception("Upload failed");
        } else if ($_POST['myData']['size'] > 65535) {
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