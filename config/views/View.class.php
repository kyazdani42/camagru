<?php

class View {

    public function render($filename, $str, $heads = 0, $array = null) {

        $title = $str;
        $photos = $array;
        require "htmlHeads.php";
        if ($heads === 1) {
            require $filename . "View.php";
        } else {
            require 'header.php';
            require $filename . "View.php";
            require 'footer.php';
        }
        require "checkErrors.php";
        require "htmlFoots.php";
    }

}