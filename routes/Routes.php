<?php

namespace RouterSpace;

use Exception;
use UserControllerSpace\ListController;
use UserControllerSpace\UserController;

class Routes
{
    public $routes = [];
    public function addRoutes($uri, $controller, $method)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
    }


    public function createRoutes()
    {
        $this->addRoutes('/', 'UserControllerSpace\ListController', 'home');
        $this->addRoutes('/index.php','UserControllerSpace\ListController', 'create');
        $this->addRoutes('/list', 'UserControllerSpace\ListController', 'listusers');
    }


    public function dispatch()
    {
        $this->createRoutes();
        try {
            if (!array_key_exists($_SERVER['REQUEST_URI'], $this->routes)) throw new Exception("URI Does not exist!");
            $controller = $this->routes[$_SERVER['REQUEST_URI']]['controller'];
            if (!class_exists($controller)) throw new Exception("Class Name Does not exist!");
            $method = $this->routes[$_SERVER['REQUEST_URI']]['method'];
            $inst = new $controller;
            if (!method_exists($inst, $method)) throw new Exception("Method Does not exist!");
            $inst->$method();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
