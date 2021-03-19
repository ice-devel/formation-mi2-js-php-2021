<?php

namespace App\Routing;

class Router
{
    private $routes;

    public function addRoute($url, $controller, $method, $params=[]) {
        $this->routes[$url] = [$controller, $method, $params];
    }

    public function match($url) {
        return isset($this->routes[$url]);
    }

    public function getController($url) {
        return $this->routes[$url][0];
    }

    public function getMethod($url) {
        return $this->routes[$url][1];
    }

    public function getParams($url) {
        return $this->routes[$url][2];
    }
}