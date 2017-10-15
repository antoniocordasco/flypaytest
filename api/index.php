<?php
header('Content-Type:application/json');
require '../common.php';

$split = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$className = '\\Routes\\' . ucfirst(strtolower($split[0]));

if (class_exists($className)) {
    $route = new $className();
    $route->run();
} else {
    http_response_code(404);
    echo json_encode(['code' => 404, 'message' => 'Wrong API controller']);
}
