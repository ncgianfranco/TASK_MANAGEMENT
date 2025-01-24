<?php

namespace App\config;

use PDO;
use PDOException;


class Database {
    private static $instance = null; //singleton instace
    private PDO $connection;

    private function __construct(){
        $this->loadEnv();
        $this->connect();
    }

    
    private function loadEnv(){
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
    }

    private function connect(){
        try{
            $dsn = $_ENV['DB_DSN'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];
            $this->connection = new PDO($dsn, $user , $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Database conecction failed" . $e->getMessage());
        }
    }

    // Get the singleton instance
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }
}
