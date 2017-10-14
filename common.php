<?php
require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';

    if (is_file(__DIR__ . '/'. $path)) {
        include __DIR__ . '/'. $path;
        return;
    }
    if (is_file(__DIR__ . '/api/' . $path)) {
        include __DIR__ . '/api/' . $path;
        return;
    }
});

// loading the appropriate fixture. Needed by behat tests
if (isset($_SERVER['HTTP_X_MOCK_FIXTURE'])) {
    include 'tests/Fixtures/' . $_SERVER['HTTP_X_MOCK_FIXTURE'].'.php';
    $className = '\\Fixtures\\' . $_SERVER['HTTP_X_MOCK_FIXTURE'];
    $mock = new $className;
    $mock->load();
}