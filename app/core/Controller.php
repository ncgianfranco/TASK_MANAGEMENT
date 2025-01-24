<?php

namespace App\app\core;

use App\app\core\Request;
use App\app\core\Response;

abstract class Controller {

    protected Request $request;
    protected Response $response;

    // Inject the request and response into the controller
    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
    }

    // simple method to output text
    protected function show(string $message){
        $this->response->body($message)->send();
    }

    protected function redirect(string $url){
        $this->response->redirect($url);
    }

}