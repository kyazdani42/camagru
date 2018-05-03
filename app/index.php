<?php

session_start();
//Models
require_once 'models/Config.class.php';
require_once 'models/Model.class.php';

require_once 'models/photo/CommentModel.class.php';
require_once 'models/photo/LikeModel.class.php';
require_once 'models/photo/PhotoModel.class.php';

require_once 'models/user/UserModel.class.php';
require_once 'models/user/RegisterModel.class.php';
require_once 'models/user/ModifModel.class.php';

//Controllers
require_once "controllers/Controller.class.php";
require_once "controllers/SessionController.class.php";

require_once "controllers/HomeController.class.php";

require_once "controllers/visitor/LoginController.class.php";
require_once "controllers/visitor/RegisterController.class.php";

require_once "controllers/user/CameraController.class.php";
require_once "controllers/user/AccountController.class.php";
require_once "controllers/user/GalleryController.class.php";
require_once "controllers/user/LogoutController.class.php";

//Viewclass
require_once 'views/View.class.php';

//Rooter
require_once 'rooter/Rooter.class.php';

define("URL", "http://192.168.99.100:8080/");
define("BASE", "/var/www/html/");

new Rooter();