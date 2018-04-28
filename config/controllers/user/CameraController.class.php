<?php

class CameraController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('camera', 'Take a pic');
    }

    public function sendPicture() {
        if (!$_POST || !isset($_POST['myData']) || $_POST['myData'] === "undefined" || !isset($_POST['staticData']) || empty($_POST['staticData']) || empty($_POST['myData']) {
            header("location: " . URL . "Camera");
            die();
        }
        $data = base64_decode($_POST['myData']);
        $data2 = base64_decode($_POST['staticData']);
        $path = $this->_createPic($data, $data2);
        $login = SessionController::getLogin();
        $image = new PhotoModel;
        $image->setPhoto($path, $login);
        header("location: " . URL . "Camera");
        die();
    }

    private function _createPic($img1, $img2) {

        $img1 = imagecreatefromstring($img1);
        $img2 = imagecreatefromstring($img2);
        $defheight = 225;
        $defwidth = 305;
        $img = imagecreatetruecolor($defwidth, $defheight);
        imagecopyresampled($img, $img1, 0, 0, 0, 0, $defwidth, $defheight, imagesx($img1), imagesy($img1));
        $path = "/var/www/html/img/" . md5(rand(0, 1000)) . ".png";
        while (file_exists($path))
            $path = "/var/www/html/img/" . md5(rand(0, 1000)) . ".png";
        imagecopy($img, $img2, 0, $defheight - imagesy($img2), 0, 0, imagesx($img2), imagesy($img2));
        imagepng($img, $path);
        imagedestroy($img);
        imagedestroy($img1);
        imagedestroy($img2);
        return ($path);
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
            die();
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
