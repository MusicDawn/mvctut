<?php

namespace RouterSpace;

use Exception;
use UserControllerSpace\ListController;
use UserControllerSpace\UserController;

trait RouterSetup 
{
    // Traits are classes that can be !USED! in another class and can't be instanitated.
    // A class can only extend one other class but it can use many traits.
    
    public function addRoutes($uri, $controller, $method)
    {
        // When we use the square bracket syntax on thel left or the '=' the contents of the square brackets will be the definition of a new key.
        // Example $test['examplekey']=[1,2]; this is the same as $test = ['examplekey' =>[1,2]];
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
    }


    protected function createRoutes()
    {
        $this->addRoutes('/', UserController::class, 'home');
        $this->addRoutes('/index.php',UserController::class, 'create');
        $this->addRoutes('/list', ListController::class, 'listusers');
        $this->addRoutes('/listfa', ListController::class, 'listusersfa');
        $this->addRoutes('/singleuser', ListController::class, 'singleuser');
        $this->addRoutes('/singleuserfa', ListController::class, 'singleuserfa');
    }
}