<?php

class Rooter {

    private $_controller;

    public function __construct() {

        $url = explode('/', rtrim($_GET['url'], '/'));

        $class = $url[0] . 'Controller';

        if ($url[0] === "setup.php") {
            require_once "config/setup.php";
            header('location: ' . URL . "Home");
            die();
        }

        if (class_exists($class) && $url[0]) {
            $this->_controller = new $class;
        } else {
            header('location: ' . URL . 'Home');
        }
        $this->_sendMethod($url);
    }

    private function _sendMethod($url) {

        if (isset($url[1]) && method_exists($this->_controller, $url[1]) && is_callable(array( $this->_controller, $url[1] )) ) {
            if (isset($url[2])) {
                $this->_controller->{$url[1]}($url[2]);
            } else {
                $this->_controller->{$url[1]}();
            }
        } else if (isset($url[1])) {
            header('location: ' . URL . $url[0]);
        } else if (method_exists($this->_controller, "display")) {
            $this->_controller->display();
        }
    }

}
