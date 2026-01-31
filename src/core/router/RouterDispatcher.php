<?php

namespace Core\Router;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

class RouterDispatcher
{
    private Dispatcher $dispatcher;

    public function __construct($routeFile)
    {
        $this->dispatcher = simpleDispatcher(function (RouteCollector $route) use ($routeFile) {
            $router = new RouteCollectorProxy($route);
            
            require $routeFile;
        });
    }

    public function dispatch(string $method, string $uri): array
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rawurldecode($uri);
        $uri = rtrim($uri, '/') ?: '/';

        return $this->dispatcher->dispatch($method, $uri);
    }
}
