<?php

class Home extends Controller {

    public function __construct() {
        parent::construct();
        echo 'this is home' . "</br>";
    }

    public function error() {
        echo 'error no params or wrong method name' . PHP_EOL;
    }
}