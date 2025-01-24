<?php 

namespace App\app\core;

class Response {
    private int $statusCode = 200;
    private array $headers = [];
    private string $body = '';

    // Set the HTTP status code
    public function status(int $code){
        $this->statusCode = $code;
        return $this;
    }

    // Set a response header
    public function header(string $name, string $value){
        $this->headers[$name] = $value;
        return $this;
    }

    // Set the response body
    public function body(string $content){
        $this->body = $content;
        return $this;
    }

    // Send the response
    public function send(){
        http_response_code($this->statusCode);
        foreach($this->headers as $name => $value){
            header("$name : $value");
        }
        echo $this->body;
    }

    // Redirec to a different URL
    public function redirect(string $url){
        echo '<pre>';
        echo var_dump($url);
        echo '</pre>';
        header("Location: $url", true, 301);
    }
}
