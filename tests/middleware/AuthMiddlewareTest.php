<?php declare(strict_types=1);

namespace App\tests\middleware;
use App\app\middleware\AuthMiddleware;
use PHPUnit\Framework\TestCase;

class AuthMiddlewareTest extends TestCase {
    public function testHandleWithNoSession() {
        // Simulate no session
        $_SESSION = [];
        $middleware = new AuthMiddleware();

        ob_start();
        $middleware->handle();
        $output = ob_get_clean();

        $this->assertStringContainsString('Location: /login', $output);
    }

    public function testHandleWithSession() {
        // Simulate an authenticated session
        $_SESSION['user'] = ['id' => 1, 'username' => 'testuser'];
        $middleware = new AuthMiddleware();

        ob_start();
        $middleware->handle();
        $output = ob_get_clean();

        $this->assertEmpty($output); // No redirection
    }
}
