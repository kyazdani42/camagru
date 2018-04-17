<?php

class Home extends Controller {

    public function __construct() {
        echo 'this is home' . "</br>";
    }

    public function default() {
        echo 'error no params or wrong method name' . PHP_EOL;
    }
}