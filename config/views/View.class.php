<?php

class View {

    public function render_error($str) {
        $title = "404 Not found";
        require 'header.php';
        echo $str;
        require 'footer.php';
    }

    public function render() {
        require 'header.php';
        require 'footer.php';
    }

}