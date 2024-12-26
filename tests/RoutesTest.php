<?php 

use RouterSpace\Routes;
use PHPUnit\Framework\TestCase;
use UserControllerSpace\UserController;

class RoutesTest extends TestCase 
{
    public function testRouteSuccessIntegration()
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

    public function testRouteUriExceptionIntegration()
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

    public function testRouteControllerExceptionIntegration()
    {
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
        $routesMock->uri ='/';
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

    public function testRouteMethodExceptionIntegration()
    {
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
        $routesMock->uri ='/';
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
}