<?php

namespace RouterSpace;

use Exception;
use RouterSpace\RouterSetup;
use RouterSpace\RoutesInterface;

class Routes implements RoutesInterface
{
    public $uri;
    //$uri1=null means that by default it is null! Also if $uri1=null means that it is not set!!
    public function __construct($uri1 = null)
    {
        // Similar to turnery means that if $uri !null then $uri = $uri1, if it is null then the code after the ?? will be executed!
        // In addition parse_url returns an Assoc array and (it is a function in PHP) is a built-in function used to parse a URL into its components.
        // PHP_URL_PATH tells parse_url() to return only the path component of the URL.
        // So lets say that we have a URL : /path/to/page?name=JohnDoe&id=123#section1 => PHP_URL_PATH will return only path/to/page from it!
        $this->uri = $uri1 ?? (isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : null);
        // if (isset($uri1)) {
        //     $this->uri = $uri1;
        // } else if (isset($_SERVER['REQUEST_URI'])) {
        //     $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // } else {
        //     $this->uri = null;
        // }
    }

    // RouterSetup is a trait so we using it like this.
    use RouterSetup;
    public $routes = [];


    public function dispatch(): void
    {
        $this->createRoutes();
        echo "<pre>";
        //Tip :: $routes is a Nested Assoc Array!
        print_r($this->routes);
        echo "</pre>";
        try {
            foreach ($this->routes as $route => $nested) {
                if (preg_match("#^$route$#", $this->uri, $matches)) {
                    $controller = $nested['controller'];
                    $method = $nested['method'];
                    array_shift($matches);
                    echo "<pre>";
                    print_r($matches);
                    print_r($nested);
                    echo "Uri: " . $this->uri;
                    echo "<br>";
                    echo "Controller: " . $controller;
                    echo "Method: " . $method;
                    echo "</pre>";
                    //This is a dynamic instantiaton since $controller is a class.
                    $inst = new $controller;
                    // ... is the spread operator which spreads all the contents of an array.
                    $inst->$method(...$matches); // = (...$matches) = $method(15 or x number)
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
