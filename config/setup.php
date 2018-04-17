<?php
require_once 'Models/Model.class.php';
require_once 'Views/View.class.php';
require_once 'Controllers/Controller.class.php';

$url = explode('/', rtrim($_GET['url'], '/'));

$file = "config/controllers/" . $url[0] . '.class.php';

if (file_exists($file)) {
    require_once "controllers/" . $url[0] . ".class.php";
    $controller = new $url[0];
} else {
    require_once "controllers/Home.class.php";
    $controller = new Home;
}

if (isset($url[1]) && method_exists($controller, $url[1])) {
    if (isset($url[2])) {
        $controller->{$url[1]}($url[2]);
    } else {
        $controller->{$url[1]}();
    }
} else {
    $controller->error();
}

?>