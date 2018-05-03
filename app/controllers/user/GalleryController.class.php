<?php

class GalleryController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render("gallery", "Gallery");
    }

    public function photos() {
        $model = new PhotoModel();
        echo $model->getAllUsrImg();
    }

}