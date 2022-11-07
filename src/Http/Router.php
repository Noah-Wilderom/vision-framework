<?php

namespace Vision\Http;

use Vision\Traits\Macroable;

class Router
{
    use Macroable;

    protected $routes;

    protected $currentController;
    protected $currentMethod;

    public function __construct($routes = [])
    {
        $this->routes = empty($routes) ? collect() : $routes;
    }

    public function get($route, $controller = false,)
    {
        $this->routes->add($route, [
            'controller' => $controller
                ? $controller[0]
                : $this->currentController,
            'method' => $controller
                ? $controller[1]
                : $controller
        ]);
    }

    public function controller(string $controller)
    {
        $this->currentController = $controller;

        return $this;
    }

    public function group($callback)
    {
        return $callback();
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
