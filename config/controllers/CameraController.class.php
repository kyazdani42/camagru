<?php

class CameraController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_view->render('camera', 'take a pic');
    }


    public function error() {}
}