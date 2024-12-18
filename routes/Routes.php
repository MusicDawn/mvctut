<?php

namespace RouterSpace;

use Exception;
use RouterSpace\RouterSetup;
use RouterSpace\RoutesInterface;

class Routes implements RoutesInterface
{
    use RouterSetup;
    public $routes = [];

    public function dispatch():void
    {
        $this->createRoutes();
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        try {
            if (!array_key_exists($uri, $this->routes)) throw new Exception("URI Does not exist!");
            $controller = $this->routes[$uri]['controller'];
            if (!class_exists($controller)) throw new Exception("Class Name Does not exist!");
            $method = $this->routes[$uri]['method'];
            $inst = new $controller;
            if (!method_exists($inst, $method)) throw new Exception("Method Does not exist!");
            $inst->$method();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
