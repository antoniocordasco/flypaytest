<?php
header('Content-Type:application/json');
require '../common.php';

$split = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$className = '\\Routes\\' . ucfirst(strtolower($split[0]));
$route = new $className();
$route->run();
