<?php

class CameraController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render('camera', 'Take a pic');
    }

    public function sendPicture() {
        if (!$_POST || !isset($_POST['myData']) || $_POST['myData'] === "undefined" || !isset($_POST['staticData']) || empty($_POST['staticData'])) {
            header("location: " . URL);
            die;
        }
        $data = base64_decode($_POST['myData']);
        $data2 = base64_decode($_POST['staticData']);
        $path = $this->_createPic($data, $data2);
        $login = SessionController::getLogin();
        $image = new PhotoModel;
        $image->setPhoto($path, $login);
        header("location: " . URL . "Camera");
    }

    private function _createPic($img1, $img2) {

        $img1 = imagecreatefromstring($img1);
        $img2 = imagecreatefromstring($img2);
        $wsrc = imagesx($img2);
        $hsrc = imagesy($img2);
        $wdst = imagesx($img1);
        $hdst = imagesy($img1);
        $destx = $wdst - $wsrc;
        $desty = $hdst - $hsrc;
        $path = "/tmp/" . md5(rand(0, 1000)) . ".jpeg";

        imagecopymerge($img1, $img2, $destx, $desty, 0, 0, $wsrc, $hsrc, 60);
        imagejpeg($img1, $path);
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