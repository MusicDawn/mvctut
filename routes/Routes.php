<?php

namespace RouterSpace;

class Routes
{
    private $routes = [];

    public function addRoutes($uri, $controller, $method)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
        if (array_key_exists($_SERVER['REQUEST_URI'], $this->routes)) {
            $controller = $this->routes[$uri]['controller'];
            if (class_exists($controller)) {
                $method = $this->routes[$uri]['method'];
                $inst = new $controller;
                if (method_exists($inst, $method)) {
                    $inst->$method();
                } else echo "Method Does not exist!";
            } else echo "Class Name Does not exist!";
        } else echo "URI Does not exist!";
    }
}
