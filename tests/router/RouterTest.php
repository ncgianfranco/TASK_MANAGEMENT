<?php declare(strict_types=1);

namespace App\tests\router;

use App\app\core\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends  TestCase{
    private Router $router;

    protected function setUp(): void{
        $this->router = new Router();
    }

    public function testAddRoute(){
        $this->router->addRoute('GET', '/test', function(){
            return 'test route';
        });

        $this->assertNotEmpty($this->router->getRoutes());
    }

    public function testDispatch(){
        $this->router->addRoute('GET', '/test', function(){
            return 'test route';
        });

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/test';

        ob_start();
        $this->router->dispatch();
        $output = ob_get_clean();

        $this->assertEquals('test Route', $output);
    }

    public function tearDown(): void{
        // clean up resources after each test
        unset($this->router);
    }
}