<?php

class GalleryController extends Controller {

    public function display() {

        parent::__construct();
        $model = new PhotoModel();
        $data = $model->getAllUsrImg();
        $this->_view->render("gallery", "Gallery", 0, $data);

    }

    public function delete($id) {

        $model = new PhotoModel();
        try {
            $model->deleteImg($id, 1);
        } catch (Exception $e) {
            if ($this->_isAjax()) {
                echo (json_encode(array('err' => $e)));
                die();
            }
            SessionController::setSession('error', $e);
            header('location: ' . URL . "Gallery");
        }
        if ($this->_isAjax()) {
            echo (json_encode($id));
            die();
        }
        header('location: ' . URL . "Gallery");

    }
}