<?php
require_once "../vendor/autoload.php";
require_once "../config/helpers.php";
require_once "../config/main.php";
require_once "../config/route.php";
$url=isset($_GET['url']) && $_GET['url']!="" ? strtolower($_GET['url']) : '/';
App\Router::route($url);


