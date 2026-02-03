<?php

use Core\Router;

require_once '../configs/path.php';

require dirname(__DIR__, 2) . '/vendor/autoload.php';

require_once '../bootstrap/app.php';

$route = new Router();

$rootPath = '/' . basename(dirname(__DIR__));
$path = str_replace($rootPath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

foreach (glob(dirname(__DIR__) . '/routes/*.php') as $filename) {
    require_once $filename;
}

$route->dispatch($path, $_SERVER['REQUEST_METHOD']);