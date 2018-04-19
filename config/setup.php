<?php
session_start();
//Models
require_once 'models/Model.class.php';
require_once 'models/UserModel.class.php';
require_once 'models/Config.class.php';

//Controllers
require_once "controllers/Controller.class.php";
require_once "controllers/SessionController.class.php";
require_once "controllers/HomeController.class.php";
require_once "controllers/LoginController.class.php";
require_once "controllers/LogoutController.class.php";
require_once "controllers/RegisterController.class.php";
require_once "controllers/CameraController.class.php";

//Viewclass
require_once 'views/View.class.php';

//Rooter
require_once 'rooter/Rooter.class.php';

define("URL", "http://192.168.99.100:8080/");

new Rooter();