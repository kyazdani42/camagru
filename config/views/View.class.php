<?php

class View {

    public function render($filename, $str, $isBase = 0) {
        $title = $str;
        if ($isBase === 1) {
            require 'baseHeader.php';
            require $filename . "View.php";
            require 'footer.php';
        } else {
            require_once "../controllers/SessionController.class.php";
            $session = new SessionController();
            require 'logHeader.php';
            require $filename . "View.php";
            require 'footer.php';
        }
    }

}