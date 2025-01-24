<?php

namespace App\app\controllers;
use App\app\core\Controller;
use App\app\models\User;
use App\app\core\Request;
use App\app\core\Response;

class AuthController extends Controller {
    private User $user;

    public function __construct(Request $request, Response $response){
        parent::__construct($request, $response);

        // initialize the user model
        $this->user = new User();
    }

    // show the registration form
    public function registerForm(){
        $this->show("Register: <form method='POST' action='/register'><input type='text' name='username' placeholder='Username' required><input type='email' name='email' placeholder='Email' required><input type='password' name='password' placeholder='Password' required><button type='submit'>Register</button></form>");
    }

    // handle registration
    public function register(){
        if($this->request->method()=== 'POST'){
            $username = $this->request->input('username');
            $email = $this->request->input('email');
            $password = $this->request->input('password');

            // validate input
            if(empty($user) && empty($email) && empty($password)){
                $this->show("All fields are required");
            }

            // check if the email is already registered
            if($this->user->findByEmail($email)){
                $this->show("Email already registered");
                return;
            }

            // Create the user
            $this->user->createUser([
                'username' => $username,
                'email' => $email,
                'password' => $password
            ]);
        }
    }

    // show the login form
    public function loginForm(){
        $this->show("Login: <form method='POST' action='/login'><input type='email' name='email' placeholder='Email' required><input type='password' name='password' placeholder='Password' required><button type='submit'>Login</button></form>");
    }

    // handle login
    public function login(){
        if($this->request->method() === 'POST'){
            $email = $this->request->input('email');
            $password = $this->request->input('password');

            // verifying credentials
            $user = $this->user->verifyCredentials($email, $password);
            if($user){
                // start a session and store user data
                session_start();
                $_SESSION['user'] = $user;
                $this->redirect('/tasks');
            } else {
                $this->show("Invalid emial or password");
            }
        }
    }

    // handle logout
    public function logout(){
        session_start();
        session_destroy();
        $this->redirect('/login');
    }
}