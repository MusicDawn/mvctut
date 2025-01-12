<?php

use RouterSpace\Routes;
use PHPUnit\Framework\TestCase;
use UserControllerSpace\ListController;
use UserControllerSpace\UserController;

class RoutesTest extends TestCase
{
    public function testRoutesSuccessIntegration()
    {
        // $_SERVER['REQUEST_URI'] = "/";
        $routes = new Routes;
        $routes->uri = '/';
        $controller = new UserController;
        ob_start();
        $routes->dispatch();
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('<div class="box">', $contents);
    }

    public function testRoutesUriExceptionIntegration()
    {
        $routes = new Routes;
        $routes->uri = '/broken';
        $controller = new UserController;
        ob_start();
        $routes->dispatch();
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('URI Does not exist!', $contents);
    }

    public function testRoutesControllerExceptionIntegration()
    {
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
        $routesMock->uri = '/';
        // $routesMock = new Routes;
        // $routesMock->craeteRoutes();
        $routesMock->expects($this->once())
            ->method('createRoutes')
            // First test example with willReturn
            ->willReturn($routesMock->routes = ['/' => ['controller' => 'Broken', 'method' => 'Broken']]);

        ob_start();
        $routesMock->dispatch();
        $contents = ob_get_clean();
        $this->assertStringContainsString('Class Name Does not exist!', $contents);
    }

    public function testRoutesMethodExceptionIntegration()
    {
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
        $routesMock->uri = '/';
        // $routesMock = new Routes;
        // $routesMock->craeteRoutes();
        $routesMock->expects($this->once())
            ->method('createRoutes')
            // Second test example with willReturnCallback
            ->willReturnCallback(function () use ($routesMock) {
                $routesMock->routes = ['/' => ['controller' => 'UserControllerSpace\UserController', 'method' => 'broken']];
            });

        ob_start();
        $routesMock->dispatch();
        $contents = ob_get_clean();
        $this->assertStringContainsString('Method Does not exist!', $contents);
    }

    //Example of test that hasnt been resolved.
    // public function testRoutesCaptureGroupIntegration()
    // {
    //     $routes = new Routes;
    //     $routes->uri = '/singleuserfawc/15';
    //     $con = $this->createMock(mysqli::class);
    //     $listctr1 = new ListController($con);
    //     ob_start();
    //     $routes->dispatch();
    //     // Use the following to see output from <pre> tag inside output methods (if they exist xD)
    //     $output = ob_get_clean();        
    //     // echo $output;
    //     $this->assertIsArray($routes->matches);
    // }

    public function testRoutesCGntegrationRegexFail()
    {
        $routes = new Routes;
        $routes->uri = '/singleuserfawc/broken';
        $con = $this->createMock(mysqli::class);
        $listctr1 = new ListController($con);
        ob_start();
        $routes->dispatch();
        // Use the following to see output from <pre> tag inside output methods (if they exist xD)
        $output = ob_get_clean();        
        // echo $output;
        $this->assertEquals('URI Does not exist!',$output);
    }
}
