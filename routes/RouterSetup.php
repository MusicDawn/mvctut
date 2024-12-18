<?php

namespace RouterSpace;

use Exception;
use UserControllerSpace\ListController;
use UserControllerSpace\UserController;

trait RouterSetup 
{
    // Traits are classes that cab be !USED! in another class and can't be instanitated
    // A class can only extend one other class but it can use many traits.
    
    public function addRoutes($uri, $controller, $method)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
    }


    protected function createRoutes()
    {
        $this->addRoutes('/', UserController::class, 'home');
        $this->addRoutes('/index.php',UserController::class, 'create');
        $this->addRoutes('/list', ListController::class, 'listusers');
    }
}