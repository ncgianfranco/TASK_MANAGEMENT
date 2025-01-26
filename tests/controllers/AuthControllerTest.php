<?php declare(strict_types=1);

namespace App\tests\controllers;
use App\app\controllers\AuthController;
use App\app\core\Request;
use App\app\core\Response;
use PHPUnit\Framework\TestCase;

class AuthControllerTest extends TestCase {
    private AuthController $authController;

    protected function setUp(): void{
        // initialize the authController with mock Request and Response Objects
        $request = new Request();
        $response = new Response();
        $this->authController = new AuthController($request, $response);
    }

    public function testRegisterForm(){
        ob_start();
        $this->authController->registerForm();
        $output = ob_get_clean();
        $this->assertStringContainsString('Register', $output);
    }

    public function testRegister(){
        $_POST = ['username' => 'testuser', 
                'email' => 'test@example.com',
                'password' => 'password'
        ];
        ob_start();
        $this->authController->register();
        $output = ob_get_clean();
        $this->assertStringContainsString('redirect', $output);
    }

    public function tearDown(): void{
        // clean up resources after each test
        unset($this->authController);
    }
}