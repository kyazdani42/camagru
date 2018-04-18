<?php

class Rooter {

    private $_controller;

    public function __construct()
    {

        $url = explode('/', rtrim($_GET['url'], '/'));

        $file = "config/controllers/" . $url[0] . 'Controller.class.php';

        if (file_exists($file) && $url[0]) {
            require_once $file;
            $name = $url[0] . "Controller";
            $this->_controller = new $name;
        } else {
            require_once "config/controllers/HomeController.class.php";
            $this->_controller = new HomeController();
        }

        $this->_sendMethod($url);
    }

    private function _sendMethod($url) {

        if (isset($url[1]) && method_exists($this->_controller, $url[1])) {
            if (isset($url[2])) {
                $this->_controller->{$url[1]}($url[2]);
            } else {
                $this->_controller->{$url[1]}();
            }
        } else if (isset($url[1])) {
            $this->_controller->error($url[1]);
        } else {
            $this->_controller->display();
        }
    }

}