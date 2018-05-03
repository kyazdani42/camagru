<?php

class GalleryController extends Controller {

    public function display() {

        parent::__construct();
        $model = new PhotoModel();
        $data = $model->getAllUsrImg();
        $this->_view->render("gallery", "Gallery", 0, $data);

    }
}