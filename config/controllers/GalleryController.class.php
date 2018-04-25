<?php

class GalleryController extends Controller {

    public function display() {
        parent::__construct();
        $this->_view->render("gallery", "Gallery");
    }

}