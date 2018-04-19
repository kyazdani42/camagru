<?php

class View {

    public function render($filename, $str, $heads = 0) {

        $title = $str;
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