<?php

use Core\Router\RouterDispatcher;
use FastRoute\Dispatcher;

require dirname(__DIR__, 2) . '/vendor/autoload.php';

require_once '../bootstrap/app.php';

$router = new RouterDispatcher(
    dirname(__DIR__) . '/routes/web.php'
);

$routeInfo = $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

if ($routeInfo[0] === Dispatcher::FOUND) {
    [$class, $method] = $routeInfo[1];

    $controller = $container->make($class);
    $controller->$method();
}
