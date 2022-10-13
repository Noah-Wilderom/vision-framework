<?php

namespace Vision\Http;

class Router
{
    protected $routes;

    protected $currentController;
    protected $currentMethod;

    public function __construct($routes = [])
    {
        $this->routes = empty($routes) ? collect() : $routes;
    }

    public function get($route, $controller = null,)
    {
        //
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
