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
        // parse_url returns an Assoc array and (it is a function in PHP) is a built-in function used to parse a URL into its components.
        // PHP_URL_PATH tells parse_url() to return only the path component of the URL.
        // So lets say that we have a URL : /path/to/page?name=JohnDoe&id=123#section1 => PHP_URL_PATH will return only path/to/page from it!
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        try {
            // array_key_exists() returns true if the given key is set in the array. key can be any value possible for an array index.
            if (!array_key_exists($uri, $this->routes)) throw new Exception("URI Does not exist!");
            $controller = $this->routes[$uri]['controller'];
            if (!class_exists($controller)) throw new Exception("Class Name Does not exist!");
            $method = $this->routes[$uri]['method'];
            $inst = new $controller;
            if (!method_exists($inst, $method)) throw new Exception("Method Does not exist!");
            $inst->$method();
            echo "<pre>";
            print_r($this->routes);
            echo "</pre>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
