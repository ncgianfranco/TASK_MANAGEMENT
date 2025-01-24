<?php

namespace App\app\controllers;

use App\app\core\Controller;

class HomeController extends Controller{
    
    public function index(){
        $this->show("HOME PAGE");
    }

    public function about(){
        $this->show("ABOUT US: THIS IS A SIMPLE TASK MANAGEMENT APPLICATION");
    }
}