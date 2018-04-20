<?php

class View {

    public function render($filename, $str, $heads = 0, $array = []) {

        $title = $str;
        $ret = 0;
        if ($array !== null) {
            extract($array);
            $ret = 1;
        }
        $filename = $this->_fileRights($filename);
        require "contents/htmlHeads.php";
        if ($heads === 1) {
            require $filename . "View.php";
        } else {
            require 'contents/header.php';
            require $filename . "View.php";
            require 'contents/footer.php';
        }
        require "contents/checkErrors.php";
    }

    private function _fileRights($filename) {

        if (SessionController::getLogin() === null || SessionController::getLogin() === "") {
            if (!file_exists('config/views/visitor/' . $filename . 'View.php')) {
                header('location: ' . URL . 'Home');
            } else {
                $filename = 'visitor/' . $filename;
            }
        } else if (file_exists('config/views/logged/' . $filename . 'View.php')){
            $filename = 'logged/' . $filename;
        } else {
            header('location: ' . URL . 'Home');
        }
        return ($filename);
    }

}