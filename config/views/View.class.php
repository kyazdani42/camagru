<?php

class View {

    public function render($filename, $str) {
        $title = $str;
        require 'header.php';
        require $filename . "View.php";
        require 'footer.php';
    }

}