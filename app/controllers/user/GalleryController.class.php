<?php

class GalleryController extends Controller {

    public function display($data = null) {
        parent::__construct();
        $this->_view->render("gallery", "Gallery", 0, $data);
    }

    public function photos() {
        $model = new PhotoModel();
        $data = $model->getAllUsrImg();
        if ($this->_isAjax()) {
            var_dump(json_encode($data));
            die();
        }
        $this->display($data);
    }

}