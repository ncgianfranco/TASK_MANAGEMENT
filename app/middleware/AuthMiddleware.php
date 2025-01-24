<?php

namespace App\app\middleware;

class AuthMiddleware {
    public function handle(){
        session_start();
        if(!isset($_SESSION['user'])){
            header("Location: /login");
            exit;
        }
    }
}

