<?php

class HomeController extends Controller {

    public function __construct() {

            parent::__construct();
            $photos = $this->_getImages();
            if (SessionController::getLogin() === "") {
                $this->_view->render('index', 'Home', 0, $photos);
            } else {
                $this->_view->render('logged', 'Home', 0, $photos);
            }
    }

    private function _getImages() {
        $obj = new ContentModel();
        $elems = $obj->getAllPhotos()->fetchAll();
        return ($elems);
    }

    public function error() {
    }
}