<?php 

namespace App\app\models;

use App\app\core\Model;

class Task extends Model {
    protected string $table = "tasks";

    // fetch all tasks
    public function getAllTasks(){
        return $this->all($this->table);
    }

    // fetch a task by ID
    public function getTaskById(int $id){
        return $this->find($this->table, $id);
    }

    // create a new task
    public function createTask(array $data){
        return $this->create($this->table, $data);
    }

    // update a task
    public function updateTask(int $id, array $data){
        return $this->update($this->table, $id, $data);
    }

    // delete a task
    public function deleteTask(int $id){
        return $this->delete($this->table, $id);
    }

    // mark a task as completed
    public function markAsCompleted(int $id){
        return $this->update($this->table, $id, ['completed' => 1]);
    }

    // fetch task by completion status
    public function getTasksByStatus(bool $completed){
        $status = $completed? 1: 0;
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE completed = :completed");
        $stmt->execute(['completed' => $status]);
        return $stmt->fetchAll();
    }
}