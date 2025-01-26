<?php
namespace App\app\controllers;

use App\app\core\Controller;
use App\app\models\Task;
use App\app\core\Request;
use App\app\core\Response;

class ApiController extends Controller {
    private Task $task;

    public function __construct(Request $request, Response $response){
        parent::__construct($request, $response);
        $this->task = new Task();
    }

    // List all tasks
    public function index(){
        $tasks = $this->task->getAllTasks();
        $this->response->body(json_encode($tasks))->send();
    }

    // Show a specific task
    public function show($id) {
        $task = $this->task->getTaskById($id);
        if ($task) {
            $this->response->body(json_encode($task))->send();
        } else {
            $this->response->status(404)->body(json_encode(['error' => 'Task not found']))->send();
        }
    }

    // Create a new task
    public function store() {
        $data = json_decode($this->request->body(), true);
        // Validate and create the task
        if (isset($data['name'])) {
            $this->task->createTask($data);
            $this->response->status(201)->body(json_encode(['message' => 'Task created successfully']))->send();
        } else {
            $this->response->status(400)->body(json_encode(['error' => 'Task name is required']))->send();
        }
    }

    // Update a task
    public function update($id) {
        $data = json_decode($this->request->body(), true);
        if ($this->task->updateTask($id, $data)) {
            $this->response->body(json_encode(['message' => 'Task updated successfully']))->send();
        } else {
            $this->response->status(404)->body(json_encode(['error' => 'Task not found']))->send();
        }
    }

    // Delete a task
    public function destroy($id) {
        if ($this->task->deleteTask($id)) {
            $this->response->status(204)->send(); // No content
        } else {
            $this->response->status(404)->body(json_encode(['error' => 'Task not found']))->send();
        }
    }
}