<?php
require_once 'Models/Model.class.php';
require_once 'Views/View.class.php';
require_once 'Controllers/Controller.class.php';

$url = explode('/', rtrim($_GET['url'], '/'));

$file = "config/controllers/" . $url[0] . 'Controller.class.php';

if (file_exists($file) && $url[0]) {
    require_once "controllers/" . $url[0] . "Controller.class.php";
    $name = $url[0] . "Controller";
    $controller = new $name;
} else {
    require_once "controllers/HomeController.class.php";
    $controller = new HomeController();
}

if (isset($url[1]) && method_exists($controller, $url[1])) {
    if (isset($url[2])) {
        $controller->{$url[1]}($url[2]);
    } else {
        $controller->{$url[1]}();
    }
} else if (isset($url[1])) {
    $controller->error($url[1]);
} else {
    $controller->display();
}