<?php 

use RouterSpace\Routes;
use PHPUnit\Framework\TestCase;
use UserControllerSpace\UserController;

class RoutesTest extends TestCase 
{
    public function testRouteSuccessIntegration()
    {
        $_SERVER['REQUEST_URI'] = "/broken";
        $routes = new Routes;
        $controller = new UserController;
        ob_start();
        $routes->dispatch();
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('URI Does not exist!', $contents);
    }

    public function testRouteUriExceptionIntegration()
    {
        $_SERVER['REQUEST_URI'] = "/broken";
        $routes = new Routes;
        $controller = new UserController;
        ob_start();
        $routes->dispatch();
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('URI Does not exist!', $contents);
    }

    public function testRouteControllerExceptionIntegration()
    {
        $_SERVER['REQUEST_URI'] = "/";
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
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
        $_SERVER['REQUEST_URI'] = "/";
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
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