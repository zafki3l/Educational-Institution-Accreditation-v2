<?php

namespace Core\Router;

use FastRoute\RouteCollector;

class RouteCollectorProxy
{
    private RouteCollector $route;

    public function __construct(RouteCollector $route)
    {
        $this->route = $route;
    }

    public function add(string $method, string $url, string $handler): void
    {
        $this->route->addRoute($method, $url, $handler);
    }

    public function get(string $url, string $handler): void
    {
        $this->add('GET', $url, $handler);
    }

    public function post(string $url, string $handler): void
    {
        $this->add('POST', $url, $handler);
    }

    public function put(string $url, string $handler): void
    {
        $this->add('PUT', $url, $handler);
    }

    public function patch(string $url, string $handler): void
    {
        $this->add('PATCH', $url, $handler);
    }

    public function delete(string $url, string $handler): void
    {
        $this->add('DELETE', $url, $handler);
    }
}