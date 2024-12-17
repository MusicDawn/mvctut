<?php
//Here we start our TEST with PHPUnit in this case we will check if the connection to out databese works.

// We do that so we don't have to wirte all this (PHPUnit\Framework\TestCase;) in our class extend point.
use PHPUnit\Framework\TestCase;
use RouterSpace\Routes;
use UserControllerSpace\UserController;

//We set up a phpunit test by setting it up as a class
class IndexTest extends TestCase
{
    private $con;
    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "panos", "", "mvctut");
    }

    // The word test... on function's name is a must
    public function testConnection()
    {
        // if ($this->con->errno===0) $result = true; the line below means this so basicly the $result is a bool.
        $result = $this->con->errno === 0;
        // assert.... are method that are used in phpunit for testing.
        $this->assertTrue($result);
    }

    // This function is commented out because phpunit is fucked up when we have headers.
    public function testIndexOutput(): void
    {
        // $_SERVER['REQUEST_URI']="/";
        // Ob = Output Buffer 
        ob_start();
        require("index.php");
        $contents = ob_get_clean();

        $this->assertStringContainsString('<body>', $contents);
    }



    public function testRouteSuccessIntegration()
    {
        $_SERVER['REQUEST_URI'] = "/";
        $routes = new Routes;
        $controller = new UserController;
        $routes->dispatch();
        ob_start();
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('<div class="box">', $contents);
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

    protected function tearDown(): void
    {
        $this->con->close();
    }
}
