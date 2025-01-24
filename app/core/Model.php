<?php

namespace App\app\core;

use App\config\Database;
use PDO;

abstract class Model {
    protected PDO $db;

    public function __construct(){
        //Get the singleton database instance
        $this->db = Database::getInstance()->getConnection();
    }

    // Example method to fetch all records from a table
    public function all(string $table){
        $stmt = $this->db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    // Example method to find a record by ID
    public function find(string $table, int $id){
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $table, array $data){
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Example method to update a record
    public function update(string $table, int $id, array $data) {
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }


    // Example method to delete a record
    public function delete(string $table, int $id) {
        $stmt = $this->db->prepare("DELETE FROM $table WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}